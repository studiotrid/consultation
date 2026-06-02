# Notification Settings Page – Implementation Notes

## Overview
This document explains how the Notification Settings page, header icon, and push subscription save flow were implemented in this project.

## 1) Header Icon + Link
**Goal:** Add a bell icon in the header that links to the notification settings page.

**Files touched**
- templates/menu.tpl
- inc/css/custom.css

**What was done**
- Added a bell icon link in the header:
  - Link target: /notification-settings.php
- Styled the icon with a circular button, hover state, and status indicator.
- Adjusted its vertical alignment to line up with the Logout button.

**Notes**
- The user name in the header was also converted into a homepage link and styled white with no underline.

## 2) Notification Settings Page (UI + Form)
**Goal:** Provide a page where users can enable/disable Push and Email notifications.

**Files touched**
- notification-settings.php
- templates/notification-settings.tpl
- inc/css/custom.css

**What was done**
- Created a dedicated page: /notification-settings.php
- Added a form with two switches:
  - Push Notifications
  - Email Notifications
- Form submits to the same page and saves to the korisnici table.
- Added success/error messages and a visual layout.

## 3) Database Fields
**Goal:** Persist notification preferences in the korisnici table.

**Columns added**
- push_notifications (TINYINT)
- email_notifications (TINYINT)

**Logic**
- On first load or on POST, the page checks if columns exist and adds them if missing.
- Values are saved on form submit.

## 4) Push Subscription Storage
**Goal:** Store actual Push subscription objects in the database.

**Files touched**
- inc/ajax/save_push_subscription.php
- inc/ajax/get_vapid_key.php

**Flow**
1. UI requests VAPID public key from get_vapid_key.php
2. Browser creates a subscription
3. Subscription is POSTed to save_push_subscription.php
4. Subscription is saved in push_subscriptions table

**Table used**
- push_subscriptions
  - user_id, coach_id
  - endpoint, auth_key, p256dh_key
  - created_at, last_updated

**Important fix**
- The Database class does not expose real_escape_string(), so all values use $db->escape().

## 5) Push Enable Flow (Client Side)
**Files touched**
- templates/notification-settings.tpl

**Logic**
- If user enables Push and has no subscription:
  - Form is saved first
  - Then service worker is registered
  - Browser subscription is created
  - Subscription is saved to server
  - Page reloads and shows success

## 6) Status/Indicator Behavior
**Files touched**
- inc/js/notification-status.js
- api/get-notification-status.php
- inc/css/custom.css

**Logic**
- A status endpoint reports current notification flags.
- The bell icon gets a pulsing effect when enabled.

## 7) Confirmation After Save
**Files touched**
- templates/notification-settings.tpl
- notification-settings.php

**Logic**
- After successful subscription save, the page redirects to:
  - /notification-settings.php?push=1
- The server shows a success message based on this parameter.

## 8) Files Reference (Quick List)
- templates/menu.tpl
- inc/css/custom.css
- notification-settings.php
- templates/notification-settings.tpl
- inc/ajax/get_vapid_key.php
- inc/ajax/save_push_subscription.php
- api/get-notification-status.php
- inc/js/notification-status.js
- service-worker.js

## iPhone Support
Web Push works on iOS 16.4+ (Safari and installed web apps). Older versions do not support it.
