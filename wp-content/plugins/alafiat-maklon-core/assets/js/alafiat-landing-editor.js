(function (wp) {
  'use strict';

  var element = wp.element.createElement;
  var RichText = wp.blockEditor.RichText;
  var InspectorControls = wp.blockEditor.InspectorControls;
  var TextControl = wp.components.TextControl;
  var TextareaControl = wp.components.TextareaControl;
  var PanelBody = wp.components.PanelBody;
  var settings = window.alafiatLandingElement;
  var landingAnchors = ['top', 'sediaan', 'sediaan-grid', 'jalur-maklon', 'simulasi', 'proses', 'faq'];

  // Gutenberg uses the block client ID on canvas elements. Expose the saved
  // anchor separately so the public section styles can also style the editor.
  wp.hooks.addFilter('editor.BlockListBlock', 'alafiat/landing-anchors', function (BlockListBlock) {
    return function (props) {
      var anchor = props.attributes && props.attributes.anchor;
      if (props.name !== 'core/group' || landingAnchors.indexOf(anchor) === -1) {
        return element(BlockListBlock, props);
      }
      return element(BlockListBlock, Object.assign({}, props, {
        wrapperProps: Object.assign({}, props.wrapperProps, { 'data-alafiat-anchor': anchor })
      }));
    };
  });

  wp.blocks.registerBlockType('alafiat/landing-element', Object.assign({}, settings, {
    edit: function (props) {
      var attributes = props.attributes;
      var tag = attributes.tagName;
      var action = tag === 'button' || tag === 'a';
      var arrowLink = tag === 'a' && (attributes.className || '').split(/\s+/).indexOf('alafiat-card-arrow') !== -1;
      var blockProps = wp.blockEditor.useBlockProps({
        className: action ? 'alafiat-editor-control' : undefined,
        'data-wa-cta': attributes.whatsappSource,
        'data-alafiat-link-target': attributes.href
      });
      var controlSetting = null;

      if (tag === 'a') {
        controlSetting = attributes.whatsappSource
          ? element(TextareaControl, {
            label: 'Pesan WhatsApp',
            value: attributes.whatsappMessage || '',
            onChange: function (value) { props.setAttributes({ whatsappMessage: value }); }
          })
          : element(TextControl, {
            label: 'Tujuan tautan',
            value: attributes.href || '',
            onChange: function (value) { props.setAttributes({ href: value }); }
          });
      }

      return element(wp.element.Fragment, null,
        controlSetting && element(InspectorControls, null,
          element(PanelBody, { title: 'Tujuan tindakan' }, controlSetting,
            arrowLink && element(TextControl, {
              label: 'Nama tautan untuk pembaca layar',
              value: attributes.accessibleLabel || '',
              onChange: function (value) { props.setAttributes({ accessibleLabel: value }); }
            }))),
        arrowLink ? element('span', Object.assign({}, blockProps, { 'aria-label': attributes.accessibleLabel })) :
          element(RichText, Object.assign({}, blockProps, {
          tagName: tag === 'button' ? 'span' : tag,
          value: attributes.content,
          placeholder: 'Tulis teks…',
          allowedFormats: ['core/bold', 'core/italic', 'core/strikethrough', 'core/subscript', 'core/superscript'],
          disableLineBreaks: action,
          onChange: function (content) { props.setAttributes({ content: content }); }
        }))
      );
    },
    save: function () { return null; }
  }));
})(window.wp);
