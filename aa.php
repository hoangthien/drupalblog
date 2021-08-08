$tree = $menu_tree->load(NULL, $parameters);
$manipulators = [
  ['callable' => 'menu.default_tree_manipulators:checkAccess'],
  ['callable' => 'menu.default_tree_manipulators:generateIndexAndSort'],
  ['callable' => 'toolbar_tools_menu_navigation_links'],
];
$tree = $menu_tree->transform($tree, $manipulators);
$build['administration_menu'] = $menu_tree->build($tree);
