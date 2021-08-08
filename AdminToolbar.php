  /**
   * Renders the toolbar's administration tray.
   *
   * This is a clone of core's toolbar_prerender_toolbar_administration_tray()
   * function, which uses setMaxDepth(4) instead of setTopLevelOnly().
   *
   * @param array $build
   *   A renderable array.
   *
   * @return array
   *   The updated renderable array.
   *
   * @see toolbar_prerender_toolbar_administration_tray()
   */
  public static function preRenderTray(array $build) {
    $menu_tree = \Drupal::service('toolbar.menu_tree');
    $parameters = new MenuTreeParameters();
    $parameters->setRoot('system.admin')->excludeRoot()->setMaxDepth(4)->onlyEnabledLinks();
    $tree = $menu_tree->load(NULL, $parameters);
    $manipulators = [
      ['callable' => 'menu.default_tree_manipulators:checkAccess'],
      ['callable' => 'menu.default_tree_manipulators:generateIndexAndSort'],
      ['callable' => 'toolbar_tools_menu_navigation_links'],
    ];
    $tree = $menu_tree->transform($tree, $manipulators);
    $build['administration_menu'] = $menu_tree->build($tree);
    return $build;
  }
