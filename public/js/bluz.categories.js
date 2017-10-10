/**
 * @author   Viacheslav Nogin
 * @created  11.09.12 10:30
 */
/* global define,require */
define(['jquery', 'bluz', 'bluz.notify', 'bluz.tools', 'bluz.ajax'], function ($, bluz, notify, tools) {
  'use strict';

  function loadTree() {
    $('.tree-wrapper').load('/categories/tree .tree-container', {id: $('.select-tree select').val()});
  }

  function reload() {
    window.location = window.location.href;
  }

  $(function () {
    $('.category-page-wrapper').on('change', '.select-tree select', loadTree);

    $('body')
      .on('success.bluz.dialog', '.create', loadTree)
      .on('success.bluz.dialog', '.create-root', reload)
      .on('success.bluz.dialog', '.edit', loadTree)
      .on('success.bluz.ajax', '.delete', loadTree)
      .on('success.bluz.ajax', '.delete-root', reload)
      .on('blur', '#name', function () {
        let $alias = $('#alias');
        if ($alias.val() === '') {
          let title = tools.alias($(this).val());
          $alias.val(title);
        }
      });
  });

  return {};
});
