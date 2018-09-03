<?php
/**
 * @var Views\FormView $this
 **/

?>
<!DOCTYPE html>
<html lang="en" class="ad-layout-narrow layout-single-column-post">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta property="og:site_name" content="All Women Stalk"/>
    <meta name="language" content="en"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=no"/>
    <meta name="referrer" content="always"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <style>
        body {
            padding-top: 5rem;
            position: absolute;
            height: 100%;
            width: 100%;
        }
        .container {
            height: 100%;
            padding-bottom: 4rem;
        }

        .tab-content {
            padding-top: 1rem;
            height: 100%;
        }
        #result, #html {
            height: 100%;
        }
        #result iframe {
            height: 100%;
            width: 100%;
            border: 0;
        }
        #html pre {
            height: 100%;
            overflow: auto;
            width: 100%;
            padding: .375rem .75rem;
            border: 1px solid #ced4da;
            border-radius: .25rem;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="">Chatter</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<main role="main" class="container">
    <ul class="nav nav-tabs" id="crosslinkTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link <?= empty($this->result) ? 'active' : ''; ?>"
               id="source-tab" data-toggle="tab" href="#source" role="tab" aria-controls="source"
               aria-selected="<?= empty($this->result) ? 'true' : 'false'; ?>">Source</a>
        </li>
        <li class="nav-item">
            <a class="nav-link"
               id="html-tab" data-toggle="tab" href="#html" role="tab" aria-controls="html"
               aria-selected="false">HTML</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  <?= !empty($this->result) ? 'active' : ''; ?>"
               id="result-tab" data-toggle="tab" href="#result" role="tab" aria-controls="result"
               aria-selected="<?= !empty($this->result) ? 'true' : 'false'; ?>">Result</a>
        </li>
    </ul>

    <div class="tab-content" id="crosslinkTabContent">
        <div class="tab-pane fade <?= empty($this->result) ? 'show active' : ''; ?>"
             id="source" role="tabpanel" aria-labelledby="source-tab">
            <form method="post" name="sourceForm" onsubmit="submit();">
                <div class="form-group">
                    <textarea id="resultSource" class="form-control" name="source" <?= empty($this->result) ? 'autofocus' : ''; ?>
                              rows="10"><?= htmlspecialchars($this->source); ?></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" onClick="this.form.submit(); this.disabled=true; this.value='Sending…';" value="Create">
                </div>
            </form>
        </div>

        <div class="tab-pane fade" id="html" role="tabpanel" aria-labelledby="html-tab">
            <pre class="prettyprint lang-html"><?= htmlspecialchars($this->result); ?></pre>
        </div>

        <div class="tab-pane fade <?= !empty($this->result) ? 'show active' : ''; ?>"
             id="result" role="tabpanel" aria-labelledby="result-tab">
            <iframe src="data:text/html,<?= rawurlencode($this->result); ?>"></iframe>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
</body>
</html>
