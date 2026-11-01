<?php

namespace Drupal\playground_isolation\EventSubscriber;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Restricts CAS authentication routes in the local playground.
 */
class CasRouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    $blocked_routes = [
      'cas.login',
      'cas.legacy_login',
      'cas.logout',
      'cas.service',
      'cas.proxyCallback',
    ];

    foreach ($blocked_routes as $route_name) {
      if ($route = $collection->get($route_name)) {
        $route->setRequirement('_access', 'FALSE');
      }
    }
  }

}
