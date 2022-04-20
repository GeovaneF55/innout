<?php
  session_start();
  requireValidSession();

  $data = [];

  loadTemplateView('save_user', $data);