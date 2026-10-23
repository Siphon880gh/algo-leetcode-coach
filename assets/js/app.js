(function () {
  'use strict';

  function copyText(text) {
    if (navigator.clipboard && navigator.clipboard.writeText) {
      return navigator.clipboard.writeText(text);
    }
    var ta = document.createElement('textarea');
    ta.value = text;
    ta.setAttribute('readonly', '');
    ta.style.position = 'absolute';
    ta.style.left = '-9999px';
    document.body.appendChild(ta);
    ta.select();
    document.execCommand('copy');
    document.body.removeChild(ta);
    return Promise.resolve();
  }

  function flashCopied(btn) {
    var prev = btn.textContent;
    btn.textContent = 'Copied';
    setTimeout(function () {
      btn.textContent = prev;
    }, 1600);
  }

  document.querySelectorAll('[data-copy-target]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var sel = btn.getAttribute('data-copy-target');
      var el = sel ? document.querySelector(sel) : null;
      if (!el) return;
      var text = el.textContent || '';
      copyText(text.trim()).then(function () {
        flashCopied(btn);
      });
    });
  });

  function fillPromptTemplate(template, values) {
    var out = template;
    Object.keys(values).forEach(function (key) {
      var raw = values[key];
      var filled = raw && String(raw).trim() !== '' ? String(raw).trim() : '___';
      out = out.split('[' + key + ']').join(filled);
    });
    return out;
  }

  document.querySelectorAll('[data-ui-builder]').forEach(function (root) {
    var template = '';
    var keys = [];
    try {
      template = JSON.parse(root.getAttribute('data-prompt') || '""');
    } catch (e) {
      template = '';
    }
    try {
      keys = JSON.parse(root.getAttribute('data-keys') || '[]');
    } catch (e2) {
      keys = [];
    }
    var preview = root.querySelector('[data-ui-builder-preview]');
    var inputs = root.querySelectorAll('[data-ui-builder-key]');

    function refresh() {
      var values = {};
      keys.forEach(function (key) {
        values[key] = '';
      });
      inputs.forEach(function (input) {
        var key = input.getAttribute('data-ui-builder-key');
        if (key) values[key] = input.value || '';
      });
      if (preview) {
        preview.textContent = fillPromptTemplate(template, values);
      }
    }

    inputs.forEach(function (input) {
      input.addEventListener('input', refresh);
    });
    refresh();

    var copyBtn = root.querySelector('[data-ui-builder-copy]');
    if (copyBtn) {
      copyBtn.addEventListener('click', function () {
        var fromSel = copyBtn.getAttribute('data-copy-from');
        var el = fromSel ? root.querySelector(fromSel) || document.querySelector(fromSel) : preview;
        if (!el) return;
        copyText((el.textContent || '').trim()).then(function () {
          flashCopied(copyBtn);
        });
      });
    }
  });

  // Coaching: client history for step-back when using choice links with data attributes
  var coachingRoot = document.getElementById('coaching-session');
  if (coachingRoot) {
    var historyKey = coachingRoot.getAttribute('data-history-key') || 'coaching-history';
    var historyInput = document.getElementById('coaching-history');

    function readHistory() {
      if (historyInput && historyInput.value) {
        try {
          return JSON.parse(historyInput.value);
        } catch (e) {
          return [];
        }
      }
      try {
        return JSON.parse(sessionStorage.getItem(historyKey) || '[]');
      } catch (e2) {
        return [];
      }
    }

    function writeHistory(stack) {
      var json = JSON.stringify(stack);
      if (historyInput) historyInput.value = json;
      sessionStorage.setItem(historyKey, json);
    }

    coachingRoot.querySelectorAll('[data-choice-next]').forEach(function (form) {
      form.addEventListener('submit', function () {
        var next = form.getAttribute('data-choice-next');
        var current = coachingRoot.getAttribute('data-node');
        var stack = readHistory();
        if (current) stack.push(current);
        writeHistory(stack);
        var histField = form.querySelector('input[name="history"]');
        if (histField) histField.value = JSON.stringify(stack);
      });
    });

    var stepBack = document.getElementById('coaching-step-back');
    if (stepBack) {
      stepBack.addEventListener('click', function (e) {
        var stack = readHistory();
        var rewindTo = stepBack.getAttribute('data-rewind-to');
        var target = null;
        if (rewindTo) {
          var idx = stack.lastIndexOf(rewindTo);
          if (idx >= 0) {
            target = rewindTo;
            stack = stack.slice(0, idx);
          } else {
            target = rewindTo;
            stack = [];
          }
        } else if (stack.length) {
          target = stack.pop();
        }
        if (!target) {
          e.preventDefault();
          return;
        }
        writeHistory(stack);
        var url = new URL(stepBack.href);
        url.searchParams.set('node', target);
        url.searchParams.set('history', JSON.stringify(stack));
        stepBack.href = url.toString();
      });
    }
  }

  var pathAiModal = document.getElementById('coaching-path-ai-modal');
  var pathAiOpen = document.getElementById('coaching-path-ai-open');
  var pathAiPreview = document.getElementById('coaching-path-ai-preview');
  var pathAiCopy = document.getElementById('coaching-path-ai-copy');
  var pathAiDone = document.getElementById('coaching-path-ai-modal-done');
  var pathAiChatgpt = document.getElementById('coaching-path-open-chatgpt');
  var pathAiClaude = document.getElementById('coaching-path-open-claude');
  var pathAiWrap = document.querySelector('[data-path-ai]');
  var pathAiSubtitle = document.getElementById('coaching-path-ai-modal-subtitle');
  var pathAiHint = document.getElementById('coaching-path-ai-hint');
  var pathAiPanel = document.getElementById('coaching-path-ai-panel');
  var pathAiTabs = pathAiModal ? pathAiModal.querySelectorAll('[data-path-ai-tab]') : [];
  var pathAiMode = 'proceed';
  var lastPathAiFocus = null;

  function parsePathAiData() {
    if (!pathAiWrap) return null;
    try {
      return JSON.parse(pathAiWrap.getAttribute('data-path-ai') || 'null');
    } catch (e) {
      return null;
    }
  }

  function pathAiHasAnswered() {
    var data = parsePathAiData();
    if (data && typeof data.answered === 'boolean') return data.answered;
    var steps = data && Array.isArray(data.steps) ? data.steps : [];
    return steps.some(function (step) {
      return step && step.choice;
    });
  }

  function coachingPathAiSideNotes(verb) {
    return 'While you ' + verb + ', add a lot of side notes. Whenever a keyword, concept, data structure, algorithm pattern, or complexity expression shows up — including hash map, two pointers, sliding window, complement, recursion, nested loops, and Big-O such as O(n), O(n²), O(n log n), O(n·k), O(n*m) — pause and explain it in a clearly labeled side note (for example: "Side note — O(n·k): …"). Assume I may not know the term yet. Do not skip jargon. Put each side note right after the sentence that used the term.';
  }

  function coachingPathAiTaskLines(mode) {
    if (mode === 'optimize') {
      return [
        'Task: Tell me how to optimize what I have so far. Stay with the decisions I already made. Point out extra work, weaker complexity, missed pruning, and concrete ways to tighten this same path. Do not throw the work away unless a change is clearly better.',
        '',
        coachingPathAiSideNotes('answer'),
        '',
        'Keep the main story linear (my path only). Reply in plain language, not JSON. Use short sections.'
      ];
    }
    if (mode === 'proceed') {
      return [
        'Task: Answer the entire problem from this point. Start from where I am now and give the complete remaining solution and reasoning — the full answer from here, not a hint or a partial nudge. Cover the approach, why it is correct, and the time and space complexity. Use my path so far as the starting point; do not restart from the beginning unless I have not taken any steps yet.',
        '',
        coachingPathAiSideNotes('answer'),
        '',
        'Reply in plain language, not JSON. Use short sections. Finish the rest of the problem from this point.'
      ];
    }
    return [
      'Task: Explain this path so far in plain English. Walk through what I decided, what each step was doing, and why those decisions matter for the problem.',
      '',
      coachingPathAiSideNotes('explain'),
      '',
      'Keep the main story linear (my path only). Reply in plain language, not JSON. Use short sections.'
    ];
  }

  function buildCoachingPathAiPrompt(data, mode) {
    if (!data || typeof data !== 'object') {
      return '';
    }
    var lines = [];
    var title = data.title ? String(data.title) : 'this step-by-step session';
    lines.push('I am working through a deterministic step-by-step algorithm session in an Algo Learning IDE.');
    lines.push('');
    lines.push('Session: ' + title);
    if (data.topic) lines.push('Topic: ' + String(data.topic));
    if (data.category || data.subcategory) {
      var filing = [data.category, data.subcategory].filter(Boolean).join(' / ');
      if (filing) lines.push('Filed as: ' + filing);
    }
    if (data.summary) lines.push('Summary: ' + String(data.summary));
    if (data.problem) {
      lines.push('');
      lines.push('Problem statement (from LeetCode):');
      lines.push(String(data.problem));
    }
    if (Array.isArray(data.tags) && data.tags.length) {
      lines.push('Tags: ' + data.tags.join(', '));
    }
    lines.push('');
    lines.push('Here is the path I have taken so far, oldest step first. Each step is a node I visited. "You chose" is the button I clicked to leave that node.');
    lines.push('');

    var steps = Array.isArray(data.steps) ? data.steps : [];
    steps.forEach(function (step, i) {
      if (!step || typeof step !== 'object') return;
      var outcome = step.outcome ? String(step.outcome) : 'continue';
      var head = 'Step ' + (i + 1) + ' — node `' + String(step.id || '') + '` (' + outcome + ')';
      if (step.current) head += ' ← I am here now';
      lines.push(head);
      var message = step.message ? String(step.message).trim() : '';
      lines.push(message !== '' ? message : '(no message)');
      if (step.choice) {
        lines.push('You chose: ' + String(step.choice));
      } else if (!step.current) {
        lines.push('Continued without a labeled choice.');
      }
      if (outcome === 'wrong' && step.rewind_to) {
        lines.push('Wrong turn — session says step back to node `' + String(step.rewind_to) + '`.');
      }
      lines.push('');
    });

    if (Array.isArray(data.open_choices) && data.open_choices.length) {
      lines.push('Choices still on the current node (I have not picked the next one yet):');
      data.open_choices.forEach(function (choice) {
        lines.push('- ' + String(choice));
      });
      lines.push('');
    }

    if (data.outcome === 'wrong' && data.rewind_to) {
      lines.push('I am on a wrong-turn leaf. The session tells me to step back to node `' + String(data.rewind_to) + '`.');
      lines.push('');
    } else if (data.outcome === 'success') {
      lines.push('I reached a success leaf.');
      lines.push('');
    }

    return lines.concat(coachingPathAiTaskLines(mode)).join('\n');
  }

  function currentCoachingPathAiPrompt() {
    return buildCoachingPathAiPrompt(parsePathAiData(), pathAiMode);
  }

  function syncCoachingPathAiTabAvailability() {
    var answered = pathAiHasAnswered();
    pathAiTabs.forEach(function (tab) {
      var mode = tab.getAttribute('data-path-ai-tab');
      var needsAnswer = mode === 'explain' || mode === 'optimize';
      tab.disabled = needsAnswer && !answered;
      if (tab.disabled) {
        tab.setAttribute('title', 'Answer a step first');
      } else {
        tab.removeAttribute('title');
      }
    });
    return answered;
  }

  function selectCoachingPathAiTab(mode) {
    var answered = syncCoachingPathAiTabAvailability();
    if ((mode === 'explain' || mode === 'optimize') && !answered) {
      mode = 'proceed';
    }
    if (mode !== 'explain' && mode !== 'optimize' && mode !== 'proceed') {
      mode = answered ? 'explain' : 'proceed';
    }
    pathAiMode = mode;
    pathAiTabs.forEach(function (tab) {
      var id = tab.getAttribute('data-path-ai-tab');
      var selected = id === mode;
      tab.setAttribute('aria-selected', selected ? 'true' : 'false');
      tab.tabIndex = selected ? 0 : -1;
      if (selected) {
        if (pathAiSubtitle && tab.getAttribute('data-subtitle')) {
          pathAiSubtitle.textContent = tab.getAttribute('data-subtitle');
        }
        if (pathAiHint && tab.getAttribute('data-hint')) {
          pathAiHint.textContent = tab.getAttribute('data-hint');
        }
        if (pathAiPanel) {
          pathAiPanel.setAttribute('aria-labelledby', tab.id);
        }
      }
    });
    if (pathAiPreview) {
      pathAiPreview.textContent = currentCoachingPathAiPrompt();
    }
  }

  function setCoachingPathAiModalOpen(open) {
    if (!pathAiModal) return;
    pathAiModal.hidden = !open;
    document.body.classList.toggle('modal-open', open);
    if (pathAiOpen) {
      pathAiOpen.setAttribute('aria-expanded', open ? 'true' : 'false');
    }
    if (open) {
      selectCoachingPathAiTab(pathAiHasAnswered() ? 'explain' : 'proceed');
      var panel = pathAiModal.querySelector('.modal__panel');
      if (panel && typeof panel.focus === 'function') {
        if (!panel.hasAttribute('tabindex')) panel.setAttribute('tabindex', '-1');
        panel.focus();
      }
    } else if (lastPathAiFocus && typeof lastPathAiFocus.focus === 'function') {
      lastPathAiFocus.focus();
    }
  }

  function copyCoachingPathAiPrompt(done) {
    copyText(currentCoachingPathAiPrompt()).then(function () {
      if (typeof done === 'function') done();
    }).catch(function () {
      if (typeof done === 'function') done();
    });
  }

  function openCoachingPathAiService(url) {
    copyCoachingPathAiPrompt(function () {
      window.open(url, '_blank', 'noopener,noreferrer');
    });
  }

  if (pathAiOpen && pathAiModal) {
    pathAiOpen.setAttribute('aria-expanded', 'false');
    pathAiOpen.addEventListener('click', function () {
      lastPathAiFocus = pathAiOpen;
      setCoachingPathAiModalOpen(true);
    });
  }

  if (pathAiModal) {
    var pathAiBackdrop = pathAiModal.querySelector('[data-action="close-coaching-path-ai-modal"]');
    if (pathAiBackdrop) {
      pathAiBackdrop.addEventListener('click', function () {
        setCoachingPathAiModalOpen(false);
      });
    }
    pathAiModal.addEventListener('click', function (e) {
      var tab = e.target.closest('[data-path-ai-tab]');
      if (!tab || tab.disabled || !pathAiModal.contains(tab)) return;
      selectCoachingPathAiTab(tab.getAttribute('data-path-ai-tab'));
    });
    var pathAiTablist = pathAiModal.querySelector('.coaching-path-ai-tabs');
    if (pathAiTablist) {
      pathAiTablist.addEventListener('keydown', function (e) {
        if (e.key !== 'ArrowLeft' && e.key !== 'ArrowRight' && e.key !== 'Home' && e.key !== 'End') {
          return;
        }
        var tab = e.target.closest('[data-path-ai-tab]');
        if (!tab) return;
        var enabled = [];
        pathAiTabs.forEach(function (item) {
          if (!item.disabled) enabled.push(item);
        });
        if (!enabled.length) return;
        var i = enabled.indexOf(tab);
        var next = null;
        if (e.key === 'Home') next = enabled[0];
        else if (e.key === 'End') next = enabled[enabled.length - 1];
        else if (e.key === 'ArrowRight') next = enabled[i < 0 ? 0 : (i + 1) % enabled.length];
        else next = enabled[i < 0 ? enabled.length - 1 : (i - 1 + enabled.length) % enabled.length];
        e.preventDefault();
        selectCoachingPathAiTab(next.getAttribute('data-path-ai-tab'));
        next.focus();
      });
    }
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && pathAiModal && !pathAiModal.hidden) {
        e.preventDefault();
        setCoachingPathAiModalOpen(false);
      }
    });
  }

  if (pathAiDone) {
    pathAiDone.addEventListener('click', function () {
      setCoachingPathAiModalOpen(false);
    });
  }

  if (pathAiCopy) {
    pathAiCopy.addEventListener('click', function () {
      copyCoachingPathAiPrompt(function () {
        flashCopied(pathAiCopy);
      });
    });
  }

  if (pathAiChatgpt) {
    pathAiChatgpt.addEventListener('click', function (e) {
      e.preventDefault();
      openCoachingPathAiService(pathAiChatgpt.href || 'https://chatgpt.com/');
    });
  }

  if (pathAiClaude) {
    pathAiClaude.addEventListener('click', function (e) {
      e.preventDefault();
      openCoachingPathAiService(pathAiClaude.href || 'https://claude.ai/new');
    });
  }

  var USER_TAG_LS_LEGACY = 'algos-user-tags-v1';
  var USER_TAG_DB = 'algos';
  var USER_TAG_DB_VERSION = 1;
  var USER_TAG_GROUPS = [
    { id: 'first-pass', label: 'First-Pass Tag' },
    { id: 'second-pass', label: 'Second-Pass Tag' }
  ];
  var USER_TAG_PRESETS = [
    { id: 'extreme', group: 'second-pass', label: 'Need extreme review', color: '#c23a2b' },
    { id: 'much', group: 'second-pass', label: 'Need much review', color: '#d97706' },
    { id: 'unsure', group: 'second-pass', label: 'Unsure if need review or that it sticks', color: '#7c3aed' },
    { id: 'pass', group: 'second-pass', label: 'Confident Pass', color: '#166534' },
    { id: 'first-no-stick', group: 'first-pass', label: 'Might not have stick for the most part', color: '#9a3412' },
    { id: 'first-maybe-stick', group: 'first-pass', label: 'Might not have stick or might have stick', color: '#1d4ed8' },
    { id: 'first-attention', group: 'first-pass', label: 'Couldn\u2019t keep attention on it', color: '#57534e' },
    { id: 'first-ready-transition', group: 'first-pass', label: 'Ready to transition', color: '#0f766e' }
  ];

  /*
   * IndexedDB `algos` — object stores shaped like MySQL tables:
   *   users(id PK AUTO_INCREMENT, name)
   *   tags(id PK AUTO_INCREMENT, user_id FK, name, color, is_preset, slug, sort_order)
   *   resource_tags(id PK AUTO_INCREMENT, user_id FK, resource_key, tag_id FK)
   *   tag_filters(id PK AUTO_INCREMENT, user_id FK, section, tag_id FK)
   * Seed: one users row, name = 'Local'
   */

  function idbReq(req) {
    return new Promise(function (resolve, reject) {
      req.onsuccess = function () {
        resolve(req.result);
      };
      req.onerror = function () {
        reject(req.error);
      };
    });
  }

  function txDone(tx) {
    return new Promise(function (resolve, reject) {
      tx.oncomplete = function () {
        resolve();
      };
      tx.onerror = function () {
        reject(tx.error);
      };
      tx.onabort = function () {
        reject(tx.error);
      };
    });
  }

  function openAlgoDb() {
    return new Promise(function (resolve, reject) {
      var req = indexedDB.open(USER_TAG_DB, USER_TAG_DB_VERSION);
      req.onupgradeneeded = function () {
        var db = req.result;
        var users;
        var tags;
        var resourceTags;
        var tagFilters;
        if (!db.objectStoreNames.contains('users')) {
          users = db.createObjectStore('users', { keyPath: 'id', autoIncrement: true });
          users.createIndex('name', 'name', { unique: true });
        }
        if (!db.objectStoreNames.contains('tags')) {
          tags = db.createObjectStore('tags', { keyPath: 'id', autoIncrement: true });
          tags.createIndex('user_id', 'user_id', { unique: false });
        }
        if (!db.objectStoreNames.contains('resource_tags')) {
          resourceTags = db.createObjectStore('resource_tags', { keyPath: 'id', autoIncrement: true });
          resourceTags.createIndex('user_id', 'user_id', { unique: false });
          resourceTags.createIndex('user_resource', ['user_id', 'resource_key'], { unique: false });
          resourceTags.createIndex('user_resource_tag', ['user_id', 'resource_key', 'tag_id'], { unique: true });
        }
        if (!db.objectStoreNames.contains('tag_filters')) {
          tagFilters = db.createObjectStore('tag_filters', { keyPath: 'id', autoIncrement: true });
          tagFilters.createIndex('user_id', 'user_id', { unique: false });
          tagFilters.createIndex('user_section_tag', ['user_id', 'section', 'tag_id'], { unique: true });
        }
      };
      req.onsuccess = function () {
        resolve(req.result);
      };
      req.onerror = function () {
        reject(req.error);
      };
    });
  }

  function readLegacyTagState() {
    try {
      var raw = JSON.parse(localStorage.getItem(USER_TAG_LS_LEGACY) || 'null');
      if (!raw || typeof raw !== 'object') return null;
      return raw;
    } catch (e) {
      return null;
    }
  }

  function ensureLocalUser(db) {
    var tx = db.transaction(['users'], 'readonly');
    return idbReq(tx.objectStore('users').getAll()).then(function (rows) {
      var i;
      for (i = 0; i < (rows || []).length; i++) {
        if (rows[i].name === 'Local') return rows[i];
      }
      var wtx = db.transaction(['users'], 'readwrite');
      return idbReq(wtx.objectStore('users').add({ name: 'Local' })).then(function (id) {
        return txDone(wtx).then(function () {
          return { id: id, name: 'Local' };
        });
      });
    });
  }

  function ensurePresetTags(db, user) {
    var tx = db.transaction(['tags'], 'readonly');
    return idbReq(tx.objectStore('tags').index('user_id').getAll(user.id)).then(function (rows) {
      var haveSlug = {};
      (rows || []).forEach(function (row) {
        if (row.slug) haveSlug[row.slug] = true;
      });
      var missing = USER_TAG_PRESETS.filter(function (preset) {
        return !haveSlug[preset.id];
      });
      if (!missing.length) return;
      var wtx = db.transaction(['tags'], 'readwrite');
      var store = wtx.objectStore('tags');
      missing.forEach(function (preset) {
        store.add({
          user_id: user.id,
          name: preset.label,
          color: preset.color,
          is_preset: 1,
          slug: preset.id,
          sort_order: USER_TAG_PRESETS.indexOf(preset)
        });
      });
      return txDone(wtx);
    });
  }

  function loadUserTagState(db, user) {
    var tx = db.transaction(['tags', 'resource_tags', 'tag_filters'], 'readonly');
    return Promise.all([
      idbReq(tx.objectStore('tags').index('user_id').getAll(user.id)),
      idbReq(tx.objectStore('resource_tags').index('user_id').getAll(user.id)),
      idbReq(tx.objectStore('tag_filters').index('user_id').getAll(user.id))
    ]).then(function (parts) {
      return {
        user: user,
        tags: parts[0] || [],
        resourceTags: parts[1] || [],
        tagFilters: parts[2] || []
      };
    });
  }

  function migrateLegacyTags(db, user) {
    var legacy = readLegacyTagState();
    if (!legacy) return Promise.resolve();
    return loadUserTagState(db, user).then(function (state) {
      var slugToId = {};
      var nameToId = {};
      var customMap = legacy.custom && typeof legacy.custom === 'object' ? legacy.custom : {};
      var customIds = Object.keys(customMap);
      var presetColors = legacy.presetColors && typeof legacy.presetColors === 'object' ? legacy.presetColors : {};
      var oldToNew = {};

      state.tags.forEach(function (row) {
        if (row.slug) slugToId[row.slug] = row.id;
        nameToId[String(row.name).trim().toLowerCase()] = row.id;
      });

      function addCustomAt(i) {
        if (i >= customIds.length) return Promise.resolve();
        var oldId = customIds[i];
        var spec = customMap[oldId] || {};
        var label = String(spec.label || oldId.replace(/^c:/, '')).trim();
        if (!label) return addCustomAt(i + 1);
        var want = label.toLowerCase();
        if (nameToId[want]) {
          oldToNew[oldId] = nameToId[want];
          return addCustomAt(i + 1);
        }
        var wtx = db.transaction(['tags'], 'readwrite');
        var row = {
          user_id: user.id,
          name: label,
          color: hexColor(spec.color, '#0d6e6e'),
          is_preset: 0,
          slug: null,
          sort_order: 100 + i
        };
        return idbReq(wtx.objectStore('tags').add(row)).then(function (id) {
          oldToNew[oldId] = id;
          nameToId[want] = id;
          return txDone(wtx);
        }).then(function () {
          return addCustomAt(i + 1);
        });
      }

      function mapOldId(oldId) {
        if (slugToId[oldId]) return slugToId[oldId];
        if (oldToNew[oldId]) return oldToNew[oldId];
        return null;
      }

      return addCustomAt(0).then(function () {
        var colorTx = db.transaction(['tags'], 'readwrite');
        var tagStore = colorTx.objectStore('tags');
        state.tags.forEach(function (row) {
          if (row.slug && presetColors[row.slug]) {
            row.color = hexColor(presetColors[row.slug], row.color);
            tagStore.put(row);
          }
        });
        return txDone(colorTx);
      }).then(function () {
        var byResource = legacy.byResource && typeof legacy.byResource === 'object' ? legacy.byResource : {};
        var rtx = db.transaction(['resource_tags'], 'readwrite');
        var rstore = rtx.objectStore('resource_tags');
        Object.keys(byResource).forEach(function (key) {
          var ids = Array.isArray(byResource[key]) ? byResource[key] : [];
          ids.forEach(function (oldId) {
            var tagId = mapOldId(oldId);
            if (!tagId) return;
            rstore.add({
              user_id: user.id,
              resource_key: key,
              tag_id: tagId
            });
          });
        });
        return txDone(rtx);
      }).then(function () {
        var filter = legacy.filter && typeof legacy.filter === 'object' ? legacy.filter : {};
        var ftx = db.transaction(['tag_filters'], 'readwrite');
        var fstore = ftx.objectStore('tag_filters');
        Object.keys(filter).forEach(function (section) {
          var ids = Array.isArray(filter[section]) ? filter[section] : [];
          ids.forEach(function (oldId) {
            var tagId = mapOldId(oldId);
            if (!tagId) return;
            fstore.add({
              user_id: user.id,
              section: section,
              tag_id: tagId
            });
          });
        });
        return txDone(ftx);
      }).then(function () {
        try {
          localStorage.removeItem(USER_TAG_LS_LEGACY);
        } catch (e2) {}
      });
    });
  }

  function bootUserTags() {
    return openAlgoDb().then(function (db) {
      return ensureLocalUser(db).then(function (user) {
        return ensurePresetTags(db, user).then(function () {
          return migrateLegacyTags(db, user).then(function () {
            return loadUserTagState(db, user).then(function (state) {
              return { db: db, state: state };
            });
          });
        });
      });
    });
  }

  function hexColor(value, fallback) {
    var raw = String(value || '').trim();
    if (/^#[0-9a-fA-F]{6}$/.test(raw)) return raw.toLowerCase();
    if (/^#[0-9a-fA-F]{3}$/.test(raw)) {
      return ('#' + raw.charAt(1) + raw.charAt(1) + raw.charAt(2) + raw.charAt(2) + raw.charAt(3) + raw.charAt(3)).toLowerCase();
    }
    return fallback || '#0d6e6e';
  }

  function inkForBg(hex) {
    var h = hexColor(hex, '#0d6e6e').slice(1);
    var r = parseInt(h.slice(0, 2), 16) / 255;
    var g = parseInt(h.slice(2, 4), 16) / 255;
    var b = parseInt(h.slice(4, 6), 16) / 255;
    var l = 0.2126 * r + 0.7152 * g + 0.0722 * b;
    return l > 0.55 ? '#1a1f24' : '#f4f1ea';
  }

  function cssEscape(id) {
    if (window.CSS && CSS.escape) return CSS.escape(id);
    return String(id).replace(/[^a-zA-Z0-9_-]/g, '\\$&');
  }

  function tagById(state, id) {
    var want = Number(id);
    var i;
    for (i = 0; i < state.tags.length; i++) {
      if (Number(state.tags[i].id) === want) return state.tags[i];
    }
    return null;
  }

  function tagGroupId(row) {
    if (!row || row.is_preset !== 1) return 'concept';
    var i;
    for (i = 0; i < USER_TAG_PRESETS.length; i++) {
      if (USER_TAG_PRESETS[i].id === row.slug) return USER_TAG_PRESETS[i].group;
    }
    return 'second-pass';
  }

  function tagGroupRank(groupId) {
    var i;
    for (i = 0; i < USER_TAG_GROUPS.length; i++) {
      if (USER_TAG_GROUPS[i].id === groupId) return i;
    }
    return USER_TAG_GROUPS.length;
  }

  function tagGroupLabel(groupId) {
    var i;
    for (i = 0; i < USER_TAG_GROUPS.length; i++) {
      if (USER_TAG_GROUPS[i].id === groupId) return USER_TAG_GROUPS[i].label;
    }
    return groupId;
  }

  function appendTagGroupHeading(parent, groupId, tagName) {
    var heading = document.createElement(tagName || 'p');
    heading.className = 'user-tag-group';
    heading.textContent = tagGroupLabel(groupId);
    parent.appendChild(heading);
  }

  function catalog(state) {
    return state.tags.slice().sort(function (a, b) {
      var ga = tagGroupRank(tagGroupId(a));
      var gb = tagGroupRank(tagGroupId(b));
      if (ga !== gb) return ga - gb;
      if (a.is_preset === 1 && b.is_preset === 1) return (a.sort_order || 0) - (b.sort_order || 0);
      return String(a.name).localeCompare(String(b.name));
    }).map(function (row) {
      return {
        id: Number(row.id),
        label: String(row.name),
        color: hexColor(row.color, '#0d6e6e'),
        preset: row.is_preset === 1,
        group: tagGroupId(row)
      };
    });
  }

  function resourceTagIds(state, key) {
    var ids = [];
    state.resourceTags.forEach(function (row) {
      if (row.resource_key === key) ids.push(Number(row.tag_id));
    });
    return ids;
  }

  function filterTagIds(state, section) {
    var ids = [];
    state.tagFilters.forEach(function (row) {
      if (row.section === section) ids.push(Number(row.tag_id));
    });
    return ids;
  }

  function findResourceTagRow(state, key, tagId) {
    var want = Number(tagId);
    var i;
    for (i = 0; i < state.resourceTags.length; i++) {
      if (state.resourceTags[i].resource_key === key && Number(state.resourceTags[i].tag_id) === want) {
        return state.resourceTags[i];
      }
    }
    return null;
  }

  function findFilterRow(state, section, tagId) {
    var want = Number(tagId);
    var i;
    for (i = 0; i < state.tagFilters.length; i++) {
      if (state.tagFilters[i].section === section && Number(state.tagFilters[i].tag_id) === want) {
        return state.tagFilters[i];
      }
    }
    return null;
  }

  function confirmRemoveTag(name) {
    return window.confirm('Remove tag "' + name + '"?');
  }

  function toggleResourceTag(db, state, key, tagId) {
    var existing = findResourceTagRow(state, key, tagId);
    var tx = db.transaction(['resource_tags'], 'readwrite');
    var store = tx.objectStore('resource_tags');
    var done = txDone(tx);
    if (existing) {
      return idbReq(store.delete(existing.id)).then(function () {
        state.resourceTags = state.resourceTags.filter(function (row) {
          return row.id !== existing.id;
        });
        return done;
      });
    }
    var row = {
      user_id: state.user.id,
      resource_key: key,
      tag_id: Number(tagId)
    };
    return idbReq(store.add(row)).then(function (id) {
      row.id = id;
      state.resourceTags.push(row);
      return done;
    });
  }

  function updateTagColor(db, state, id, color) {
    var row = tagById(state, id);
    if (!row) return Promise.resolve();
    row.color = hexColor(color, row.color);
    var tx = db.transaction(['tags'], 'readwrite');
    var done = txDone(tx);
    return idbReq(tx.objectStore('tags').put(row)).then(function () {
      return done;
    });
  }

  function clearSectionTagFilters(db, state, section) {
    var rows = state.tagFilters.filter(function (row) {
      return row.section === section;
    });
    if (!rows.length) return Promise.resolve();
    var tx = db.transaction(['tag_filters'], 'readwrite');
    var store = tx.objectStore('tag_filters');
    var done = txDone(tx);
    rows.forEach(function (row) {
      store.delete(row.id);
    });
    state.tagFilters = state.tagFilters.filter(function (row) {
      return row.section !== section;
    });
    return done;
  }

  function toggleFilterTag(db, state, section, tagId) {
    var existing = findFilterRow(state, section, tagId);
    var tx = db.transaction(['tag_filters'], 'readwrite');
    var store = tx.objectStore('tag_filters');
    var done = txDone(tx);
    if (existing) {
      return idbReq(store.delete(existing.id)).then(function () {
        state.tagFilters = state.tagFilters.filter(function (row) {
          return row.id !== existing.id;
        });
        return done;
      });
    }
    var row = {
      user_id: state.user.id,
      section: section,
      tag_id: Number(tagId)
    };
    return idbReq(store.add(row)).then(function (id) {
      row.id = id;
      state.tagFilters.push(row);
      return done;
    });
  }

  function syncMenuLayer() {
    document.querySelectorAll('.browse, .clist').forEach(function (root) {
      var open = false;
      var nodes = root.querySelectorAll('[data-pop-panel], [data-filter-tags-panel], [data-filter-companies-panel], [data-filter-difficulty-panel], [data-filter-source-panel], [data-filter-company-level-panel], [data-user-tag-picker]');
      var i;
      for (i = 0; i < nodes.length; i++) {
        if (nodes[i].hidden) continue;
        if (nodes[i].parentElement && nodes[i].parentElement.closest('[hidden]')) continue;
        open = true;
        break;
      }
      root.classList.toggle('is-menu-open', open);
    });
  }

  function closeUserTagPickers(except) {
    document.querySelectorAll('[data-user-tag-picker]').forEach(function (picker) {
      if (except && picker === except) return;
      picker.hidden = true;
      var open = picker.parentNode && picker.parentNode.querySelector('[data-user-tag-open]');
      if (open) open.setAttribute('aria-expanded', 'false');
    });
    syncMenuLayer();
  }

  function initUserTags() {
    var root = document.querySelector('[data-user-tags-root]');
    if (!root) return;

    var section = root.getAttribute('data-user-tag-section') || 'guides';
    var tiles = root.querySelectorAll('[data-user-tag-resource]');
    var tagFlyouts = root.querySelectorAll('[data-filter-tags]');

    function setTagFlyoutOpen(wrap, open) {
      var btn = wrap && wrap.querySelector('[data-filter-tags-btn]');
      var panel = wrap && wrap.querySelector('[data-filter-tags-panel]');
      if (!btn || !panel) return;
      if (!open) wrap.classList.remove('is-pinned');
      panel.hidden = !open;
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
      syncMenuLayer();
    }

    bootUserTags().then(function (boot) {
      var db = boot.db;
      var state = boot.state;

      function applyFilterVisibility() {
        root._filterTagIds = filterTagIds(state, section);
        root._resourceTagIdsFor = function (key) {
          return resourceTagIds(state, key);
        };
        applyBrowseTileFilters(root);
      }

      root._applyResourceFilter = applyFilterVisibility;
      root._clearTagFilters = function () {
        return clearSectionTagFilters(db, state, section);
      };
      root._renderTagFilters = function () {
        renderFilters();
      };
      bindFilterClear(root);

      function renderApplied(tile) {
        var key = tile.getAttribute('data-user-tag-resource');
        var wrap = tile.querySelector('[data-user-tags-applied]');
        if (!wrap || !key) return;
        wrap.textContent = '';
        resourceTagIds(state, key).forEach(function (id) {
          var row = tagById(state, id);
          if (!row) return;
          var chip = document.createElement('button');
          chip.type = 'button';
          chip.className = 'user-tag';
          chip.setAttribute('data-tag-id', String(id));
          chip.textContent = row.name;
          chip.setAttribute('aria-label', 'Remove tag ' + row.name);
          chip.style.background = hexColor(row.color, '#0d6e6e');
          chip.style.color = inkForBg(row.color);
          chip.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            if (!confirmRemoveTag(row.name)) return;
            toggleResourceTag(db, state, key, id).then(renderAll);
          });
          wrap.appendChild(chip);
        });
      }

      function appendChoice(picker, tileKey, def, applied) {
        var btn = document.createElement('button');
        var on = applied.indexOf(def.id) >= 0;
        btn.type = 'button';
        btn.className = 'user-tag-choice' + (on ? ' is-on' : '');
        btn.setAttribute('aria-pressed', on ? 'true' : 'false');
        var swatch = document.createElement('span');
        swatch.className = 'user-tag-choice__swatch';
        swatch.setAttribute('data-tag-id', String(def.id));
        swatch.style.background = def.color;
        var name = document.createElement('span');
        name.textContent = def.label;
        btn.appendChild(swatch);
        btn.appendChild(name);
        if (on) {
          var mark = document.createElement('span');
          mark.className = 'user-tag-choice__mark';
          mark.textContent = '✓';
          mark.setAttribute('aria-hidden', 'true');
          btn.appendChild(mark);
        }
        btn.addEventListener('click', function (e) {
          e.preventDefault();
          e.stopPropagation();
          if (on && !confirmRemoveTag(def.label)) return;
          toggleResourceTag(db, state, tileKey, def.id).then(renderAll);
        });
        picker.appendChild(btn);
      }

      function renderPicker(tile) {
        var key = tile.getAttribute('data-user-tag-resource');
        var picker = tile.querySelector('[data-user-tag-picker]');
        if (!picker || !key) return;
        picker.textContent = '';
        var applied = resourceTagIds(state, key);
        var lastGroup = null;
        catalog(state).forEach(function (def) {
          if (!def.preset) return;
          if (def.group !== lastGroup) {
            lastGroup = def.group;
            appendTagGroupHeading(picker, def.group, 'p');
          }
          appendChoice(picker, key, def, applied);
        });
      }

      function paintTagColor(id, next) {
        var ink = inkForBg(next);
        root.querySelectorAll('[data-tag-id="' + cssEscape(String(id)) + '"]').forEach(function (el) {
          if (el.classList.contains('user-tag')) {
            el.style.background = next;
            el.style.color = ink;
          } else if (el.classList.contains('user-tag-choice__swatch')) {
            el.style.background = next;
          } else if (el.classList.contains('user-tag-swatch') && el.tagName === 'INPUT' && el !== document.activeElement) {
            el.value = next;
          }
        });
      }

      function renderFilterRow(list, def, selected) {
        var row = document.createElement('li');
        row.className = 'user-tag-filter-row';
        var wrap = document.createElement('div');
        wrap.className = 'filter-tag' + (selected.indexOf(def.id) >= 0 ? ' is-current' : '');
        var swatchWrap = document.createElement('span');
        swatchWrap.className = 'user-tag-swatch-wrap';
        var swatch = document.createElement('input');
        swatch.type = 'color';
        swatch.className = 'user-tag-swatch';
        swatch.value = hexColor(def.color, '#0d6e6e');
        swatch.setAttribute('data-tag-id', String(def.id));
        swatch.setAttribute('aria-label', 'Change color for ' + def.label);
        swatch.addEventListener('click', function (e) {
          e.stopPropagation();
        });
        swatch.addEventListener('mousedown', function (e) {
          e.stopPropagation();
        });
        swatch.addEventListener('input', function (e) {
          e.stopPropagation();
          var next = hexColor(swatch.value, def.color);
          updateTagColor(db, state, def.id, next).then(function () {
            paintTagColor(def.id, next);
          });
        });
        swatchWrap.appendChild(swatch);
        var opt = document.createElement('button');
        opt.type = 'button';
        opt.className = 'filter-tag__label';
        opt.setAttribute('aria-pressed', selected.indexOf(def.id) >= 0 ? 'true' : 'false');
        opt.textContent = def.label;
        opt.addEventListener('click', function (e) {
          e.preventDefault();
          e.stopPropagation();
          toggleFilterTag(db, state, section, def.id).then(function () {
            renderFilters();
            applyFilterVisibility();
          });
        });
        wrap.appendChild(swatchWrap);
        wrap.appendChild(opt);
        row.appendChild(wrap);
        list.appendChild(row);
      }

      function renderFilters() {
        var selected = filterTagIds(state, section);
        var byGroup = {};
        catalog(state).forEach(function (def) {
          if (!byGroup[def.group]) byGroup[def.group] = [];
          byGroup[def.group].push(def);
        });
        root._tagIdsByGroup = {};
        Object.keys(byGroup).forEach(function (groupId) {
          root._tagIdsByGroup[groupId] = byGroup[groupId].map(function (def) {
            return def.id;
          });
        });
        root.querySelectorAll('[data-user-tag-filters]').forEach(function (list) {
          var groupId = list.getAttribute('data-tag-group');
          if (!groupId) return;
          list.textContent = '';
          (byGroup[groupId] || []).forEach(function (def) {
            renderFilterRow(list, def, selected);
          });
        });
      }

      function renderAll() {
        tiles.forEach(function (tile) {
          renderApplied(tile);
          var picker = tile.querySelector('[data-user-tag-picker]');
          if (picker && !picker.hidden) renderPicker(tile);
        });
        renderFilters();
        applyFilterVisibility();
      }

      tiles.forEach(function (tile) {
        var openBtn = tile.querySelector('[data-user-tag-open]');
        var picker = tile.querySelector('[data-user-tag-picker]');
        if (!openBtn || !picker) return;
        openBtn.addEventListener('click', function (e) {
          e.preventDefault();
          e.stopPropagation();
          var willOpen = picker.hidden;
          closeUserTagPickers();
          if (willOpen) {
            renderPicker(tile);
            picker.hidden = false;
            openBtn.setAttribute('aria-expanded', 'true');
            syncMenuLayer();
          }
        });
        picker.addEventListener('click', function (e) {
          e.stopPropagation();
        });
      });

      tagFlyouts.forEach(function (wrap) {
        var btn = wrap.querySelector('[data-filter-tags-btn]');
        var panel = wrap.querySelector('[data-filter-tags-panel]');
        if (!btn || !panel) return;
        wrap.addEventListener('mouseenter', function () {
          closeFilterCompaniesFlyout(root, true);
          closeFilterDifficultyFlyout(root, true);
          closeFilterSourceFlyout(root, true);
          closeFilterTagsFlyout(root, true, wrap);
          setTagFlyoutOpen(wrap, true);
        });
        holdFlyout(wrap, function () {
          if (!wrap.classList.contains('is-pinned')) setTagFlyoutOpen(wrap, false);
        });
        btn.addEventListener('click', function (e) {
          e.preventDefault();
          e.stopPropagation();
          closeFilterCompaniesFlyout(root, true);
          closeFilterDifficultyFlyout(root, true);
          closeFilterSourceFlyout(root, true);
          closeFilterTagsFlyout(root, true, wrap);
          if (panel.hidden) {
            wrap.classList.add('is-pinned');
            setTagFlyoutOpen(wrap, true);
          } else if (wrap.classList.contains('is-pinned')) {
            setTagFlyoutOpen(wrap, false);
          } else {
            wrap.classList.add('is-pinned');
            setTagFlyoutOpen(wrap, true);
          }
        });
        panel.addEventListener('click', function (e) {
          e.stopPropagation();
        });
      });

      document.addEventListener('click', function () {
        closeUserTagPickers();
        closeFilterTagsFlyout(root, true);
      });

      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeUserTagPickers();
      });

      renderAll();
    });
  }

  initUserTags();

  var BROWSE_SORT_MODES = ['usual', 'az', 'za', 'lc', 'lcdesc'];
  var BROWSE_PERSIST_PREFIX = 'algos-browse-state-v1:';

  function browsePersistKey() {
    var path = String(window.location.pathname || '').replace(/\/+$/, '') || '/';
    var kind = '';
    try {
      kind = new URLSearchParams(window.location.search).get('kind') || '';
    } catch (err) {}
    return BROWSE_PERSIST_PREFIX + path + (kind ? '?kind=' + kind : '');
  }

  function readBrowsePersist() {
    try {
      var raw = JSON.parse(localStorage.getItem(browsePersistKey()) || 'null');
      if (!raw || typeof raw !== 'object') return { sort: 'usual', q: '' };
      var sort = raw.sort;
      if (BROWSE_SORT_MODES.indexOf(sort) < 0) sort = 'usual';
      var q = typeof raw.q === 'string' ? raw.q : '';
      return { sort: sort, q: q };
    } catch (err) {
      return { sort: 'usual', q: '' };
    }
  }

  function writeBrowsePersist(patch) {
    var cur = readBrowsePersist();
    if (patch.sort !== undefined) cur.sort = patch.sort;
    if (patch.q !== undefined) cur.q = patch.q;
    try {
      var key = browsePersistKey();
      if (cur.sort === 'usual' && String(cur.q).trim() === '') {
        localStorage.removeItem(key);
      } else {
        localStorage.setItem(key, JSON.stringify(cur));
      }
    } catch (err) {}
  }

  function browseSearchQuery(root) {
    var input = root.querySelector('[data-browse-search-input]');
    return input ? String(input.value || '').trim().toLowerCase() : '';
  }

  function browseTileMatches(tile, q) {
    if (!q) return true;
    return (tile.getAttribute('data-browse-q') || '').indexOf(q) !== -1;
  }

  function companyFilterStorageKey() {
    return 'algos-company-filter-v1:' + browsePersistKey().slice(BROWSE_PERSIST_PREFIX.length);
  }

  function readCompanyFilter() {
    try {
      var raw = JSON.parse(localStorage.getItem(companyFilterStorageKey()) || 'null');
      if (!Array.isArray(raw)) return [];
      return raw.filter(function (slug) {
        return typeof slug === 'string' && slug !== '';
      });
    } catch (err) {
      return [];
    }
  }

  function writeCompanyFilter(slugs) {
    try {
      var key = companyFilterStorageKey();
      if (!slugs.length) localStorage.removeItem(key);
      else localStorage.setItem(key, JSON.stringify(slugs));
    } catch (err) {}
  }

  function tileCompanySlugs(tile) {
    var raw = tile.getAttribute('data-companies');
    if (!raw) return [];
    return raw.split(/\s+/).filter(Boolean);
  }

  function tileMatchesCompanies(tile, selected) {
    if (!selected.length) return true;
    var have = tileCompanySlugs(tile);
    var i;
    for (i = 0; i < selected.length; i++) {
      if (have.indexOf(selected[i]) >= 0) return true;
    }
    return false;
  }

  var DIFFICULTY_FILTER_IDS = ['easy', 'med', 'hard'];
  var SOURCE_FILTER_IDS = ['leetcode', 'non-leetcode'];

  function sourceFilterStorageKey() {
    return 'algos-source-filter-v1:' + browsePersistKey().slice(BROWSE_PERSIST_PREFIX.length);
  }

  function readSourceFilter() {
    try {
      var fromUrl = new URLSearchParams(window.location.search).get('source');
      if (fromUrl && SOURCE_FILTER_IDS.indexOf(fromUrl) >= 0) {
        return [fromUrl];
      }
      var raw = JSON.parse(localStorage.getItem(sourceFilterStorageKey()) || 'null');
      if (!Array.isArray(raw)) return [];
      return raw.filter(function (id) {
        return SOURCE_FILTER_IDS.indexOf(id) >= 0;
      });
    } catch (err) {
      return [];
    }
  }

  function writeSourceFilter(ids) {
    try {
      var key = sourceFilterStorageKey();
      if (!ids.length) localStorage.removeItem(key);
      else localStorage.setItem(key, JSON.stringify(ids));
    } catch (err) {}
  }

  function tileMatchesSource(tile, selected) {
    if (!selected.length) return true;
    var have = tile.getAttribute('data-source') || 'non-leetcode';
    return selected.indexOf(have) >= 0;
  }

  function paintSourceFilterOptions(root, selected) {
    var selectedSet = {};
    selected.forEach(function (id) {
      selectedSet[id] = true;
    });
    root.querySelectorAll('[data-filter-source-opt]').forEach(function (btn) {
      var id = btn.getAttribute('data-filter-source-opt');
      var on = !!selectedSet[id];
      btn.classList.toggle('is-current', on);
      btn.setAttribute('aria-pressed', on ? 'true' : 'false');
    });
  }


  function difficultyFilterStorageKey() {
    return 'algos-difficulty-filter-v1:' + browsePersistKey().slice(BROWSE_PERSIST_PREFIX.length);
  }

  function readDifficultyFilter() {
    try {
      var raw = JSON.parse(localStorage.getItem(difficultyFilterStorageKey()) || 'null');
      if (!Array.isArray(raw)) return [];
      return raw.filter(function (id) {
        return DIFFICULTY_FILTER_IDS.indexOf(id) >= 0;
      });
    } catch (err) {
      return [];
    }
  }

  function writeDifficultyFilter(ids) {
    try {
      var key = difficultyFilterStorageKey();
      if (!ids.length) localStorage.removeItem(key);
      else localStorage.setItem(key, JSON.stringify(ids));
    } catch (err) {}
  }

  function tileMatchesDifficulty(tile, selected) {
    if (!selected.length) return true;
    var have = tile.getAttribute('data-difficulty') || '';
    return selected.indexOf(have) >= 0;
  }

  function paintDifficultyFilterOptions(root, selected) {
    var selectedSet = {};
    selected.forEach(function (id) {
      selectedSet[id] = true;
    });
    root.querySelectorAll('[data-filter-difficulty-opt]').forEach(function (btn) {
      var id = btn.getAttribute('data-filter-difficulty-opt');
      var on = !!selectedSet[id];
      btn.classList.toggle('is-current', on);
      btn.setAttribute('aria-pressed', on ? 'true' : 'false');
    });
  }

  function companySlugsInLevel(level) {
    var searching = !!(level.closest('.is-searching'));
    return Array.prototype.map.call(level.querySelectorAll('[data-filter-company]'), function (btn) {
      if (searching) {
        var li = btn.closest('li');
        if (li && li.classList.contains('is-miss')) return '';
      }
      return btn.getAttribute('data-filter-company') || '';
    }).filter(Boolean);
  }

  function paintCompanyFilterOptions(root, selected) {
    var selectedSet = {};
    selected.forEach(function (slug) {
      selectedSet[slug] = true;
    });
    root.querySelectorAll('[data-filter-company]').forEach(function (btn) {
      var slug = btn.getAttribute('data-filter-company');
      var on = !!selectedSet[slug];
      btn.classList.toggle('is-current', on);
      btn.setAttribute('aria-pressed', on ? 'true' : 'false');
    });
    root.querySelectorAll('[data-filter-company-level]').forEach(function (level) {
      var n = 0;
      companySlugsInLevel(level).forEach(function (slug) {
        if (selectedSet[slug]) n += 1;
      });
      var btn = level.querySelector('[data-filter-company-level-btn]');
      if (btn) btn.classList.toggle('has-company-filter', n > 0);
      var count = level.querySelector('[data-filter-company-level-n]');
      if (count) {
        count.hidden = n === 0;
        count.textContent = '(' + n + ')';
      }
    });
  }

  function applyBrowseTileFilters(root) {
    if (!root) return;
    var selectedTags = root._filterTagIds || [];
    var selectedCompanies = root._companyFilterSlugs || [];
    var selectedDifficulty = root._difficultyFilterIds || [];
    var selectedSource = root._sourceFilterIds || [];
    var q = browseSearchQuery(root);
    var tiles = root.querySelectorAll('.content-tile');
    var headingCount = root.querySelector('.browse__heading .resource-n');
    var filterBtn = root.querySelector('[aria-controls="resource-filter"]');
    var companiesBtn = root.querySelector('[data-filter-companies-btn]');
    var difficultyBtn = root.querySelector('[data-filter-difficulty-btn]');
    var sourceBtn = root.querySelector('[data-filter-source-btn]');
    var clearBtn = root.querySelector('[data-filter-clear]');
    var emptyEl = root.querySelector('[data-user-tag-empty]');
    var browseEmpty = root.querySelector('[data-browse-empty]');
    var lookup = root._resourceTagIdsFor;
    var shown = 0;
    var anyShown = false;

    tiles.forEach(function (tile) {
      var tagOk = selectedTags.length === 0;
      if (!tagOk && lookup) {
        var key = tile.getAttribute('data-user-tag-resource');
        var ids = key ? lookup(key) : [];
        var i;
        for (i = 0; i < selectedTags.length; i++) {
          if (ids.indexOf(selectedTags[i]) >= 0) {
            tagOk = true;
            break;
          }
        }
      }
      var companyOk = tileMatchesCompanies(tile, selectedCompanies);
      var difficultyOk = tileMatchesDifficulty(tile, selectedDifficulty);
      var sourceOk = tileMatchesSource(tile, selectedSource);
      var searchOk = browseTileMatches(tile, q);
      var visible = tagOk && companyOk && difficultyOk && sourceOk && searchOk;
      tile.hidden = !visible;
      tile.classList.toggle('is-browse-miss', !visible);
      if (visible) {
        anyShown = true;
        shown += 1;
      }
    });

    if (headingCount) headingCount.textContent = '(' + shown + ')';
    var currentTopicN = root.querySelector('.pop__list--topics .pop__opt.is-current .resource-n');
    if (currentTopicN) currentTopicN.textContent = '(' + shown + ')';
    if (browseEmpty) browseEmpty.hidden = !(q !== '' && !anyShown);
    if (emptyEl) {
      var filterMiss = q === '' && (selectedTags.length > 0 || selectedCompanies.length > 0 || selectedDifficulty.length > 0 || selectedSource.length > 0) && !anyShown;
      emptyEl.hidden = !filterMiss;
      if (filterMiss) {
        var kinds = (selectedTags.length ? 1 : 0) + (selectedCompanies.length ? 1 : 0) + (selectedDifficulty.length ? 1 : 0) + (selectedSource.length ? 1 : 0);
        if (kinds > 1) {
          emptyEl.textContent = 'No resources match those filters.';
        } else if (selectedCompanies.length) {
          emptyEl.textContent = 'No resources for those companies.';
        } else if (selectedDifficulty.length) {
          emptyEl.textContent = 'No resources at that difficulty.';
        } else if (selectedSource.length) {
          emptyEl.textContent = 'No resources for that source.';
        } else {
          emptyEl.textContent = 'No resources with that tag.';
        }
      }
    }

    var topicOn = !!(filterBtn && filterBtn.classList.contains('is-active'));
    var tagOn = selectedTags.length > 0;
    var companyOn = selectedCompanies.length > 0;
    var difficultyOn = selectedDifficulty.length > 0;
    var sourceOn = selectedSource.length > 0;
    if (filterBtn) {
      filterBtn.classList.toggle('has-filter', topicOn || tagOn || companyOn || difficultyOn || sourceOn);
      filterBtn.classList.toggle('has-tag-filter', tagOn);
      filterBtn.classList.toggle('has-company-filter', companyOn);
      filterBtn.classList.toggle('has-difficulty-filter', difficultyOn);
      filterBtn.classList.toggle('has-source-filter', sourceOn);
    }
    root.querySelectorAll('[data-filter-tags]').forEach(function (wrap) {
      var btn = wrap.querySelector('[data-filter-tags-btn]');
      if (!btn) return;
      var group = wrap.getAttribute('data-filter-tag-group') || '';
      var ids = (root._tagIdsByGroup && root._tagIdsByGroup[group]) || [];
      var groupOn = false;
      var i;
      for (i = 0; i < selectedTags.length; i++) {
        if (ids.indexOf(selectedTags[i]) >= 0) {
          groupOn = true;
          break;
        }
      }
      btn.classList.toggle('has-tag-filter', groupOn);
    });
    if (companiesBtn) companiesBtn.classList.toggle('has-company-filter', companyOn);
    if (difficultyBtn) difficultyBtn.classList.toggle('has-difficulty-filter', difficultyOn);
    if (sourceBtn) sourceBtn.classList.toggle('has-source-filter', sourceOn);
    if (clearBtn) clearBtn.hidden = !(topicOn || tagOn || companyOn || difficultyOn || sourceOn);
    paintCompanyFilterOptions(root, selectedCompanies);
    paintDifficultyFilterOptions(root, selectedDifficulty);
    paintSourceFilterOptions(root, selectedSource);
  }

  function bindFilterClear(root) {
    if (!root || root._filterClearBound) return;
    var clearBtn = root.querySelector('[data-filter-clear]');
    if (!clearBtn) return;
    root._filterClearBound = true;
    clearBtn.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      var filterBtn = root.querySelector('[aria-controls="resource-filter"]');
      var topicOn = !!(filterBtn && filterBtn.classList.contains('is-active'));
      var href = clearBtn.getAttribute('href');
      var tasks = [];
      if (typeof root._clearCompanyFilter === 'function') tasks.push(root._clearCompanyFilter());
      if (typeof root._clearDifficultyFilter === 'function') tasks.push(root._clearDifficultyFilter());
      if (typeof root._clearSourceFilter === 'function') tasks.push(root._clearSourceFilter());
      if (typeof root._clearTagFilters === 'function') tasks.push(root._clearTagFilters());
      Promise.all(tasks).then(function () {
        if (topicOn && href) {
          window.location.href = href;
          return;
        }
        if (typeof root._renderTagFilters === 'function') root._renderTagFilters();
        if (typeof root._applyResourceFilter === 'function') root._applyResourceFilter();
        else applyBrowseTileFilters(root);
      });
    });
  }

  function closeFilterTagsFlyout(root, unpin, except) {
    if (!root) return;
    root.querySelectorAll('[data-filter-tags]').forEach(function (wrap) {
      if (except && wrap === except) return;
      if (unpin) wrap.classList.remove('is-pinned');
      var panel = wrap.querySelector('[data-filter-tags-panel]');
      var btn = wrap.querySelector('[data-filter-tags-btn]');
      if (panel) panel.hidden = true;
      if (btn) btn.setAttribute('aria-expanded', 'false');
    });
    syncMenuLayer();
  }

  function clearFlyoutPlace(panel) {
    if (!panel) return;
    panel.style.position = '';
    panel.style.left = '';
    panel.style.top = '';
    panel.style.right = '';
    panel.style.bottom = '';
    panel.style.margin = '';
    panel.style.maxHeight = '';
    panel.style.maxWidth = '';
    panel.style.minWidth = '';
    panel.style.width = '';
    panel.style.visibility = '';
    panel.style.zIndex = '';
    panel.classList.remove('is-open-right');
    var list = panel.querySelector(':scope > .pop__list');
    if (list) list.style.maxHeight = '';
  }

  function placeFilterFlyout(panel, anchor) {
    if (!panel || !anchor || panel.hidden) return;
    var margin = 8;
    var gap = 6;
    var vw = window.innerWidth;
    var vh = window.innerHeight;
    var header = document.querySelector('.site-header');
    var headerBottom = header ? header.getBoundingClientRect().bottom : 0;
    var topLimit = Math.max(margin, Math.round(headerBottom) + 6);
    var anchorRect = anchor.getBoundingClientRect();
    var spaceLeft = anchorRect.left - margin - gap;
    var spaceRight = vw - anchorRect.right - margin - gap;
    var openLeft = spaceLeft >= spaceRight;
    var space = openLeft ? spaceLeft : spaceRight;
    space = Math.max(140, Math.min(space, vw - margin * 2));
    var available = Math.max(160, vh - topLimit - margin);

    var placing = panel.style.position !== 'fixed';
    panel.classList.toggle('is-open-right', !openLeft);
    panel.style.position = 'fixed';
    panel.style.margin = '0';
    panel.style.right = 'auto';
    panel.style.bottom = 'auto';
    panel.style.zIndex = panel.hasAttribute('data-filter-company-level-panel') ? '36' : '35';
    panel.style.width = '';
    panel.style.maxWidth = space + 'px';
    panel.style.maxHeight = '';
    panel.style.minWidth = space < 320 ? '0px' : '';
    if (placing) {
      panel.style.visibility = 'hidden';
      panel.style.left = margin + 'px';
      panel.style.top = margin + 'px';
    }

    var list = panel.querySelector(':scope > .pop__list');
    if (list && !panel.closest('.is-searching')) {
      list.style.maxHeight = available + 'px';
      var panelBox = panel.getBoundingClientRect();
      var listBox = list.getBoundingClientRect();
      var chrome = Math.max(0, panelBox.height - listBox.height);
      list.style.maxHeight = Math.max(120, available - chrome) + 'px';
    }

    var rect = panel.getBoundingClientRect();
    if (rect.width > space + 1) {
      panel.style.width = Math.floor(space) + 'px';
      rect = panel.getBoundingClientRect();
    }
    var width = Math.min(rect.width, vw - margin * 2);
    var height = Math.min(rect.height, vh - margin * 2);
    var left = openLeft ? anchorRect.left - gap - width : anchorRect.right + gap;
    if (left < margin) left = margin;
    if (left + width > vw - margin) left = Math.max(margin, vw - margin - width);
    var top = anchorRect.top;
    if (top + height > vh - margin) top = vh - margin - height;
    if (top < topLimit) top = topLimit;
    panel.style.left = Math.round(left) + 'px';
    panel.style.top = Math.round(top) + 'px';
    panel.style.visibility = '';
  }

  function holdFlyout(el, close) {
    var timer = 0;
    el.addEventListener('mouseenter', function () {
      if (!timer) return;
      window.clearTimeout(timer);
      timer = 0;
    });
    el.addEventListener('mouseleave', function () {
      if (timer) window.clearTimeout(timer);
      timer = window.setTimeout(function () {
        timer = 0;
        close();
      }, 320);
    });
  }

  var filterFlyoutFollowBound = false;
  function ensureFilterFlyoutFollow() {
    if (filterFlyoutFollowBound) return;
    filterFlyoutFollowBound = true;
    var queued = 0;
    function follow() {
      if (queued) return;
      queued = window.requestAnimationFrame(function () {
        queued = 0;
        document.querySelectorAll('[data-filter-companies-panel]').forEach(function (panel) {
          if (panel.hidden) return;
          var anchor = document.querySelector('[data-filter-companies-btn]');
          if (anchor) placeFilterFlyout(panel, anchor);
        });
        document.querySelectorAll('[data-filter-company-level-panel]').forEach(function (panel) {
          if (panel.hidden || panel.closest('.is-searching')) return;
          var level = panel.closest('[data-filter-company-level]');
          var anchor = level && level.querySelector('[data-filter-company-level-btn]');
          if (anchor) placeFilterFlyout(panel, anchor);
        });
      });
    }
    window.addEventListener('resize', follow);
    window.addEventListener('scroll', follow);
  }

  function setCompanyLevelOpen(level, open, unpin) {
    var btn = level.querySelector('[data-filter-company-level-btn]');
    var panel = level.querySelector('[data-filter-company-level-panel]');
    var searching = !!(level.closest('.is-searching'));
    if (searching) return;
    if (unpin || !open) level.classList.remove('is-pinned');
    if (!open) {
      if (panel) {
        panel.hidden = true;
        clearFlyoutPlace(panel);
      }
      if (btn) btn.setAttribute('aria-expanded', 'false');
      syncMenuLayer();
      return;
    }
    if (panel) {
      panel.hidden = false;
      placeFilterFlyout(panel, btn || level);
    }
    if (btn) btn.setAttribute('aria-expanded', 'true');
    syncMenuLayer();
  }

  function closeFilterCompaniesFlyout(root, unpin) {
    var wrap = root.querySelector('[data-filter-companies]');
    var btn = root.querySelector('[data-filter-companies-btn]');
    var panel = root.querySelector('[data-filter-companies-panel]');
    if (unpin && wrap) wrap.classList.remove('is-pinned');
    root.querySelectorAll('[data-filter-company-level]').forEach(function (level) {
      setCompanyLevelOpen(level, false, true);
    });
    if (panel) {
      panel.hidden = true;
      clearFlyoutPlace(panel);
    }
    if (btn) btn.setAttribute('aria-expanded', 'false');
    syncMenuLayer();
  }


  function closeFilterSourceFlyout(root, unpin) {
    var wrap = root.querySelector('[data-filter-source]');
    var btn = root.querySelector('[data-filter-source-btn]');
    var panel = root.querySelector('[data-filter-source-panel]');
    if (unpin && wrap) wrap.classList.remove('is-pinned');
    if (panel) panel.hidden = true;
    if (btn) btn.setAttribute('aria-expanded', 'false');
    syncMenuLayer();
  }

  function closeFilterDifficultyFlyout(root, unpin) {
    var wrap = root.querySelector('[data-filter-difficulty]');
    var btn = root.querySelector('[data-filter-difficulty-btn]');
    var panel = root.querySelector('[data-filter-difficulty-panel]');
    if (unpin && wrap) wrap.classList.remove('is-pinned');
    if (panel) panel.hidden = true;
    if (btn) btn.setAttribute('aria-expanded', 'false');
    syncMenuLayer();
  }

  function closeFilterNested(panel) {
    if (!panel) return;
    var root = panel.closest('.browse') || panel;
    closeFilterTagsFlyout(root, true);
    closeFilterCompaniesFlyout(root, true);
    closeFilterDifficultyFlyout(root, true);
    closeFilterSourceFlyout(root, true);
  }

  function initCompanyFilter() {
    var wrap = document.querySelector('[data-filter-companies]');
    var root = wrap && wrap.closest('.browse');
    if (!wrap || !root) return;

    var companiesBtn = wrap.querySelector('[data-filter-companies-btn]');
    var companiesPanel = wrap.querySelector('[data-filter-companies-panel]');
    if (!companiesBtn || !companiesPanel) return;

    root._companyFilterSlugs = readCompanyFilter();

    function setSelected(slugs) {
      var seen = {};
      var next = [];
      slugs.forEach(function (slug) {
        if (!slug || seen[slug]) return;
        seen[slug] = true;
        next.push(slug);
      });
      root._companyFilterSlugs = next;
      writeCompanyFilter(next);
      if (next.length) wrap.classList.add('is-pinned');
      if (typeof root._applyResourceFilter === 'function') root._applyResourceFilter();
      applyBrowseTileFilters(root);
    }

    function applyCompanySearch() {
      var search = wrap.querySelector('[data-filter-company-search]');
      var query = search ? String(search.value || '').trim().toLowerCase() : '';
      var searching = query !== '';
      wrap.classList.toggle('is-searching', searching);
      if (searching) wrap.classList.add('is-pinned');
      var anyLevel = false;
      wrap.querySelectorAll('[data-filter-company-level]').forEach(function (level) {
        var panel = level.querySelector('[data-filter-company-level-panel]');
        var levelBtn = level.querySelector('[data-filter-company-level-btn]');
        if (panel) {
          clearFlyoutPlace(panel);
          if (searching) {
            panel.hidden = false;
            if (levelBtn) levelBtn.setAttribute('aria-expanded', 'true');
            level.classList.remove('is-pinned');
          } else if (!level.classList.contains('is-pinned')) {
            panel.hidden = true;
            if (levelBtn) levelBtn.setAttribute('aria-expanded', 'false');
          }
        }
        var any = false;
        level.querySelectorAll('[data-filter-company]').forEach(function (btn) {
          var hay = (btn.textContent || '').toLowerCase();
          var hit = !searching || hay.indexOf(query) !== -1;
          var li = btn.closest('li');
          if (li) li.classList.toggle('is-miss', searching && !hit);
          if (hit) any = true;
        });
        level.classList.toggle('is-miss', searching && !any);
        if (!searching || any) anyLevel = true;
      });
      var empty = wrap.querySelector('[data-filter-company-empty]');
      if (empty) empty.hidden = !(searching && !anyLevel);
      if (!companiesPanel.hidden) placeFilterFlyout(companiesPanel, companiesBtn);
    }

    function setCompaniesOpen(open) {
      if (!open && !wrap.classList.contains('is-pinned')) {
        closeFilterCompaniesFlyout(root, false);
        return;
      }
      if (!open) {
        closeFilterCompaniesFlyout(root, true);
        return;
      }
      companiesPanel.hidden = false;
      companiesBtn.setAttribute('aria-expanded', 'true');
      placeFilterFlyout(companiesPanel, companiesBtn);
      ensureFilterFlyoutFollow();
    }

    function openLevel(level) {
      root.querySelectorAll('[data-filter-company-level]').forEach(function (other) {
        if (other !== level) setCompanyLevelOpen(other, false, true);
      });
      setCompanyLevelOpen(level, true);
    }

    wrap.addEventListener('mouseenter', function () {
      closeFilterTagsFlyout(root, true);
      closeFilterDifficultyFlyout(root, true);
      closeFilterSourceFlyout(root, true);
      setCompaniesOpen(true);
    });
    holdFlyout(wrap, function () {
      if (!wrap.classList.contains('is-pinned')) setCompaniesOpen(false);
    });
    companiesBtn.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      closeFilterTagsFlyout(root, true);
      closeFilterDifficultyFlyout(root, true);
      closeFilterSourceFlyout(root, true);
      if (companiesPanel.hidden) {
        wrap.classList.add('is-pinned');
        setCompaniesOpen(true);
        if (companySearch) companySearch.focus();
      } else if (wrap.classList.contains('is-pinned')) {
        setCompaniesOpen(false);
      } else {
        wrap.classList.add('is-pinned');
        setCompaniesOpen(true);
        if (companySearch) companySearch.focus();
      }
    });
    companiesPanel.addEventListener('click', function (e) {
      e.stopPropagation();
    });

    wrap.querySelectorAll('[data-filter-company-level]').forEach(function (level) {
      var levelBtn = level.querySelector('[data-filter-company-level-btn]');
      var levelPanel = level.querySelector('[data-filter-company-level-panel]');
      var selectAll = level.querySelector('[data-filter-company-select-all]');
      var clearLevel = level.querySelector('[data-filter-company-clear]');
      if (!levelBtn || !levelPanel) return;

      level.addEventListener('mouseenter', function () {
        if (wrap.classList.contains('is-searching')) return;
        openLevel(level);
      });
      holdFlyout(level, function () {
        if (wrap.classList.contains('is-searching')) return;
        if (!level.classList.contains('is-pinned')) setCompanyLevelOpen(level, false);
      });
      levelBtn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        if (wrap.classList.contains('is-searching')) return;
        if (levelPanel.hidden) {
          level.classList.add('is-pinned');
          openLevel(level);
        } else if (level.classList.contains('is-pinned')) {
          setCompanyLevelOpen(level, false, true);
        } else {
          level.classList.add('is-pinned');
          openLevel(level);
        }
      });
      if (selectAll) {
        selectAll.addEventListener('click', function (e) {
          e.preventDefault();
          e.stopPropagation();
          var current = (root._companyFilterSlugs || []).slice();
          companySlugsInLevel(level).forEach(function (slug) {
            if (current.indexOf(slug) < 0) current.push(slug);
          });
          setSelected(current);
        });
      }
      if (clearLevel) {
        clearLevel.addEventListener('click', function (e) {
          e.preventDefault();
          e.stopPropagation();
          var drop = {};
          companySlugsInLevel(level).forEach(function (slug) {
            drop[slug] = true;
          });
          setSelected((root._companyFilterSlugs || []).filter(function (slug) {
            return !drop[slug];
          }));
        });
      }
    });

    var companySearch = wrap.querySelector('[data-filter-company-search]');
    if (companySearch) {
      companySearch.addEventListener('click', function (e) {
        e.stopPropagation();
      });
      companySearch.addEventListener('focus', function () {
        wrap.classList.add('is-pinned');
      });
      companySearch.addEventListener('input', function () {
        applyCompanySearch();
      });
      companySearch.addEventListener('keydown', function (e) {
        e.stopPropagation();
        if (e.key === 'Escape' && companySearch.value) {
          e.preventDefault();
          companySearch.value = '';
          applyCompanySearch();
        }
      });
    }

    wrap.querySelectorAll('[data-filter-company]').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var slug = btn.getAttribute('data-filter-company');
        if (!slug) return;
        var current = (root._companyFilterSlugs || []).slice();
        var idx = current.indexOf(slug);
        if (idx >= 0) current.splice(idx, 1);
        else current.push(slug);
        setSelected(current);
      });
    });

    root._clearCompanyFilter = function () {
      setSelected([]);
      return Promise.resolve();
    };
    if (typeof root._applyResourceFilter !== 'function') {
      root._applyResourceFilter = function () {
        applyBrowseTileFilters(root);
      };
    }
    bindFilterClear(root);
    applyBrowseTileFilters(root);
  }

  initCompanyFilter();

  function initDifficultyFilter() {
    var wrap = document.querySelector('[data-filter-difficulty]');
    var root = wrap && wrap.closest('.browse');
    if (!wrap || !root) return;

    var difficultyBtn = wrap.querySelector('[data-filter-difficulty-btn]');
    var difficultyPanel = wrap.querySelector('[data-filter-difficulty-panel]');
    if (!difficultyBtn || !difficultyPanel) return;

    root._difficultyFilterIds = readDifficultyFilter();

    function setSelected(ids) {
      var seen = {};
      var next = [];
      ids.forEach(function (id) {
        if (DIFFICULTY_FILTER_IDS.indexOf(id) < 0 || seen[id]) return;
        seen[id] = true;
        next.push(id);
      });
      root._difficultyFilterIds = next;
      writeDifficultyFilter(next);
      if (next.length) wrap.classList.add('is-pinned');
      if (typeof root._applyResourceFilter === 'function') root._applyResourceFilter();
      applyBrowseTileFilters(root);
    }

    function setDifficultyOpen(open) {
      if (!open && !wrap.classList.contains('is-pinned')) {
        closeFilterDifficultyFlyout(root, false);
        return;
      }
      if (!open) {
        closeFilterDifficultyFlyout(root, true);
        return;
      }
      difficultyPanel.hidden = false;
      difficultyBtn.setAttribute('aria-expanded', 'true');
      syncMenuLayer();
    }

    wrap.addEventListener('mouseenter', function () {
      closeFilterTagsFlyout(root, true);
      closeFilterCompaniesFlyout(root, true);
      closeFilterSourceFlyout(root, true);
      setDifficultyOpen(true);
    });
    holdFlyout(wrap, function () {
      if (!wrap.classList.contains('is-pinned')) setDifficultyOpen(false);
    });
    difficultyBtn.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      closeFilterTagsFlyout(root, true);
      closeFilterCompaniesFlyout(root, true);
      closeFilterSourceFlyout(root, true);
      if (difficultyPanel.hidden) {
        wrap.classList.add('is-pinned');
        setDifficultyOpen(true);
      } else if (wrap.classList.contains('is-pinned')) {
        setDifficultyOpen(false);
      } else {
        wrap.classList.add('is-pinned');
        setDifficultyOpen(true);
      }
    });
    difficultyPanel.addEventListener('click', function (e) {
      e.stopPropagation();
    });

    wrap.querySelectorAll('[data-filter-difficulty-opt]').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var id = btn.getAttribute('data-filter-difficulty-opt');
        if (!id) return;
        var current = (root._difficultyFilterIds || []).slice();
        var idx = current.indexOf(id);
        if (idx >= 0) current.splice(idx, 1);
        else current.push(id);
        setSelected(current);
      });
    });

    root._clearDifficultyFilter = function () {
      setSelected([]);
      return Promise.resolve();
    };
    if (typeof root._applyResourceFilter !== 'function') {
      root._applyResourceFilter = function () {
        applyBrowseTileFilters(root);
      };
    }
    bindFilterClear(root);
    applyBrowseTileFilters(root);
  }

  initDifficultyFilter();

  function initSourceFilter() {
    var wrap = document.querySelector('[data-filter-source]');
    var root = wrap && wrap.closest('.browse');
    if (!wrap || !root) return;

    var sourceBtn = wrap.querySelector('[data-filter-source-btn]');
    var sourcePanel = wrap.querySelector('[data-filter-source-panel]');
    if (!sourceBtn || !sourcePanel) return;

    root._sourceFilterIds = readSourceFilter();

    function setSelected(ids) {
      var seen = {};
      var next = [];
      ids.forEach(function (id) {
        if (SOURCE_FILTER_IDS.indexOf(id) < 0 || seen[id]) return;
        seen[id] = true;
        next.push(id);
      });
      root._sourceFilterIds = next;
      writeSourceFilter(next);
      if (next.length) wrap.classList.add('is-pinned');
      if (typeof root._applyResourceFilter === 'function') root._applyResourceFilter();
      applyBrowseTileFilters(root);
    }

    function setSourceOpen(open) {
      if (!open && !wrap.classList.contains('is-pinned')) {
        closeFilterSourceFlyout(root, false);
        return;
      }
      if (!open) {
        closeFilterSourceFlyout(root, true);
        return;
      }
      sourcePanel.hidden = false;
      sourceBtn.setAttribute('aria-expanded', 'true');
      syncMenuLayer();
    }

    wrap.addEventListener('mouseenter', function () {
      closeFilterTagsFlyout(root, true);
      closeFilterCompaniesFlyout(root, true);
      closeFilterDifficultyFlyout(root, true);
      setSourceOpen(true);
    });
    holdFlyout(wrap, function () {
      if (!wrap.classList.contains('is-pinned')) setSourceOpen(false);
    });
    sourceBtn.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      closeFilterTagsFlyout(root, true);
      closeFilterCompaniesFlyout(root, true);
      closeFilterDifficultyFlyout(root, true);
      if (sourcePanel.hidden) {
        wrap.classList.add('is-pinned');
        setSourceOpen(true);
      } else if (wrap.classList.contains('is-pinned')) {
        setSourceOpen(false);
      } else {
        wrap.classList.add('is-pinned');
        setSourceOpen(true);
      }
    });
    sourcePanel.addEventListener('click', function (e) {
      e.stopPropagation();
    });

    wrap.querySelectorAll('[data-filter-source-opt]').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var id = btn.getAttribute('data-filter-source-opt');
        if (!id) return;
        var current = (root._sourceFilterIds || []).slice();
        var idx = current.indexOf(id);
        if (idx >= 0) current.splice(idx, 1);
        else current.push(id);
        setSelected(current);
      });
    });

    root._clearSourceFilter = function () {
      setSelected([]);
      return Promise.resolve();
    };
    if (typeof root._applyResourceFilter !== 'function') {
      root._applyResourceFilter = function () {
        applyBrowseTileFilters(root);
      };
    }
    bindFilterClear(root);
    applyBrowseTileFilters(root);
  }

  initSourceFilter();


  function syncBrowseIndicator(root) {
    var btn = root.querySelector('[aria-controls="resource-browse"]');
    if (!btn) return;
    var filtered = browseSearchQuery(root) !== '';
    var sorted = (root.getAttribute('data-browse-sort-mode') || 'usual') !== 'usual';
    var on = filtered || sorted;
    btn.classList.toggle('has-filter', on);
    if (!on) btn.removeAttribute('aria-label');
    else if (filtered && sorted) btn.setAttribute('aria-label', 'Browse, filtered and sorted');
    else if (filtered) btn.setAttribute('aria-label', 'Browse, filtered');
    else btn.setAttribute('aria-label', 'Browse, sorted');
  }

  function initBrowseSearch() {
    var MAX_SUGGEST = 8;

    function kids(parent, selector) {
      return Array.prototype.filter.call(parent.children, function (el) {
        return el.matches(selector);
      });
    }

    function accLabel(details) {
      var label = details.querySelector(':scope > .taxonomy-acc__summary .taxonomy-acc__label');
      return label ? (label.textContent || '').trim() : '';
    }

    function topicText(li) {
      var name = li.querySelector('.taxonomy-topics__name');
      var lc = li.querySelector('.taxonomy-topics__lc');
      var bits = [];
      if (name) bits.push(name.textContent || '');
      if (lc) bits.push(lc.textContent || '');
      return bits.join(' ');
    }

    function topicName(li) {
      var name = li.querySelector('.taxonomy-topics__name');
      return name ? (name.textContent || '').trim() : '';
    }

    document.querySelectorAll('[data-browse-search]').forEach(function (wrap) {
      var panel = wrap.closest('[data-pop-panel]');
      var root = wrap.closest('.browse');
      var input = wrap.querySelector('[data-browse-search-input]');
      var clearBtn = wrap.querySelector('[data-browse-search-clear]');
      var suggest = wrap.querySelector('[data-browse-suggest]');
      var nav = panel && panel.querySelector('.taxonomy');
      if (!panel || !root || !input || !suggest || !nav) return;

      var headingCount = root.querySelector('.browse__heading .resource-n');
      var browseEmpty = root.querySelector('[data-browse-empty]');
      var tiles = root.querySelectorAll('.content-tile');
      var activeIndex = -1;

      nav.querySelectorAll('details.taxonomy-acc').forEach(function (d) {
        d.setAttribute('data-was-open', d.open ? '1' : '0');
      });

      function optionEls() {
        return Array.prototype.slice.call(suggest.querySelectorAll('[role="option"]'));
      }

      function closeSuggest() {
        suggest.hidden = true;
        suggest.innerHTML = '';
        activeIndex = -1;
        input.setAttribute('aria-expanded', 'false');
        input.removeAttribute('aria-activedescendant');
      }

      function setActive(index) {
        var opts = optionEls();
        if (!opts.length) {
          activeIndex = -1;
          input.removeAttribute('aria-activedescendant');
          return;
        }
        if (index < 0) index = opts.length - 1;
        if (index >= opts.length) index = 0;
        activeIndex = index;
        opts.forEach(function (opt, i) {
          var on = i === activeIndex;
          opt.classList.toggle('is-active', on);
          opt.setAttribute('aria-selected', on ? 'true' : 'false');
          if (on) {
            input.setAttribute('aria-activedescendant', opt.id);
            if (opt.scrollIntoView) opt.scrollIntoView({ block: 'nearest' });
          }
        });
      }

      function collectTopics() {
        var out = [];
        nav.querySelectorAll('.taxonomy-topics li').forEach(function (li) {
          var name = topicName(li);
          if (!name) return;
          out.push({
            name: name,
            hay: topicText(li).toLowerCase(),
            li: li
          });
        });
        return out;
      }

      function applyAccordion(q) {
        kids(nav, '.taxonomy-acc').forEach(function (cat) {
          var catHit = q !== '' && accLabel(cat).toLowerCase().indexOf(q) !== -1;
          var anySub = false;
          kids(cat, '.taxonomy-acc').forEach(function (sub) {
            var subHit = q !== '' && accLabel(sub).toLowerCase().indexOf(q) !== -1;
            var list = sub.querySelector(':scope > .taxonomy-topics');
            var anyTopic = false;
            if (list) {
              kids(list, 'li').forEach(function (li) {
                var hit = q === '' || catHit || subHit || topicText(li).toLowerCase().indexOf(q) !== -1;
                li.hidden = !hit;
                if (hit) anyTopic = true;
              });
            }
            var showSub = q === '' || catHit || subHit || anyTopic;
            sub.hidden = !showSub;
            if (showSub) {
              anySub = true;
              if (q && (subHit || anyTopic || catHit)) sub.open = true;
              else if (!q) sub.open = sub.getAttribute('data-was-open') === '1';
            }
          });
          var showCat = q === '' || catHit || anySub;
          cat.hidden = !showCat;
          if (showCat) {
            if (q && (catHit || anySub)) cat.open = true;
            else if (!q) cat.open = cat.getAttribute('data-was-open') === '1';
          }
        });
      }

      function applyTiles(q) {
        if (typeof root._applyResourceFilter === 'function') {
          root._applyResourceFilter();
          return;
        }
        var shown = 0;
        tiles.forEach(function (tile) {
          var ok = browseTileMatches(tile, q);
          tile.classList.toggle('is-browse-miss', !ok);
          if (ok) shown += 1;
        });
        if (headingCount) headingCount.textContent = '(' + shown + ')';
        if (browseEmpty) browseEmpty.hidden = !(q !== '' && shown === 0);
      }

      function renderSuggest(q) {
        suggest.innerHTML = '';
        activeIndex = -1;
        if (q === '') {
          closeSuggest();
          return;
        }
        var matches = [];
        var seen = {};
        collectTopics().forEach(function (row) {
          if (matches.length >= MAX_SUGGEST) return;
          if (row.hay.indexOf(q) === -1) return;
          var key = row.name.toLowerCase();
          if (seen[key]) return;
          seen[key] = true;
          matches.push(row);
        });
        if (!matches.length) {
          closeSuggest();
          return;
        }
        matches.forEach(function (row, i) {
          var li = document.createElement('li');
          li.setAttribute('role', 'presentation');
          var btn = document.createElement('button');
          btn.type = 'button';
          btn.className = 'browse-search__opt';
          btn.setAttribute('role', 'option');
          btn.id = 'browse-opt-' + i;
          btn.setAttribute('aria-selected', 'false');
          btn.textContent = row.name;
          btn.addEventListener('mousedown', function (e) {
            e.preventDefault();
          });
          btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            pick(row.name);
          });
          li.appendChild(btn);
          suggest.appendChild(li);
        });
        suggest.hidden = false;
        input.setAttribute('aria-expanded', 'true');
      }

      function applyQuery() {
        var q = browseSearchQuery(root);
        if (clearBtn) clearBtn.hidden = q === '';
        syncBrowseIndicator(root);
        applyAccordion(q);
        applyTiles(q);
        writeBrowsePersist({ q: input.value });
      }

      function pick(name) {
        input.value = name;
        closeSuggest();
        applyQuery();
      }

      function clearSearch() {
        input.value = '';
        closeSuggest();
        applyQuery();
        input.focus();
      }

      input.addEventListener('input', function () {
        var q = browseSearchQuery(root);
        applyQuery();
        renderSuggest(q);
      });

      input.addEventListener('keydown', function (e) {
        var opts = optionEls();
        if (e.key === 'ArrowDown' && !suggest.hidden && opts.length) {
          e.preventDefault();
          setActive(activeIndex + 1);
          return;
        }
        if (e.key === 'ArrowUp' && !suggest.hidden && opts.length) {
          e.preventDefault();
          setActive(activeIndex - 1);
          return;
        }
        if (e.key === 'Enter' && !suggest.hidden && opts.length) {
          e.preventDefault();
          var chosen = activeIndex >= 0 ? opts[activeIndex] : opts[0];
          if (chosen) pick(chosen.textContent || '');
          return;
        }
        if (e.key === 'Escape') {
          if (!suggest.hidden) {
            e.preventDefault();
            e.stopPropagation();
            closeSuggest();
          }
        }
      });

      if (clearBtn) {
        clearBtn.addEventListener('click', function (e) {
          e.preventDefault();
          e.stopPropagation();
          clearSearch();
        });
      }

      nav.addEventListener('mousedown', function () {
        closeSuggest();
      });

      root._restoreBrowseSearch = function (q) {
        input.value = q || '';
        closeSuggest();
        applyQuery();
      };
    });
  }

  initBrowseSearch();

  function initBrowseSort() {
    var modes = BROWSE_SORT_MODES;
    var labels = { usual: 'Sort', az: 'A-Z', za: 'Z-A', lc: '1-n', lcdesc: 'n-1' };
    var spoken = {
      usual: 'Sort, usual order',
      az: 'Sort, A to Z',
      za: 'Sort, Z to A',
      lc: 'Sort, LeetCode number ascending',
      lcdesc: 'Sort, LeetCode number descending'
    };

    function kids(parent, selector) {
      return Array.prototype.filter.call(parent.children, function (el) {
        return el.matches(selector);
      });
    }

    function stamp(nodes) {
      nodes.forEach(function (el, i) {
        el.setAttribute('data-browse-ord', String(i));
      });
    }

    function nameOfAcc(details) {
      var label = details.querySelector(':scope > .taxonomy-acc__summary .taxonomy-acc__label');
      return label ? (label.textContent || '').trim() : '';
    }

    function nameOfTopic(li) {
      var name = li.querySelector('.taxonomy-topics__name');
      return name ? (name.textContent || '').trim() : '';
    }

    function lcOfTopic(li) {
      var raw = li.getAttribute('data-leetcode');
      if (raw === null || raw === '') return null;
      var n = Number(raw);
      return isFinite(n) ? n : null;
    }

    function byOrd(a, b) {
      return Number(a.getAttribute('data-browse-ord')) - Number(b.getAttribute('data-browse-ord'));
    }

    function reorder(parent, nodes, mode, getName, getLc) {
      var ordered = nodes.slice();
      if (mode === 'usual') {
        ordered.sort(byOrd);
      } else if (mode === 'lc' || mode === 'lcdesc') {
        if (!getLc) {
          ordered.sort(byOrd);
        } else {
          ordered.sort(function (a, b) {
            var na = getLc(a);
            var nb = getLc(b);
            if (na === null && nb === null) return byOrd(a, b);
            if (na === null) return 1;
            if (nb === null) return -1;
            if (na !== nb) return mode === 'lcdesc' ? nb - na : na - nb;
            return byOrd(a, b);
          });
        }
      } else {
        ordered.sort(function (a, b) {
          return getName(a).localeCompare(getName(b), undefined, { numeric: true, sensitivity: 'base' });
        });
        if (mode === 'za') ordered.reverse();
      }
      ordered.forEach(function (el) {
        parent.appendChild(el);
      });
    }

    function titleOfTile(tile) {
      var title = tile.querySelector('.content-tile__title');
      return title ? (title.textContent || '').trim() : '';
    }

    function lcOfTile(tile) {
      var raw = tile.getAttribute('data-leetcode');
      if (raw === null || raw === '') return null;
      var n = Number(raw);
      return isFinite(n) ? n : null;
    }

    function applySort(nav, mode, tileList) {
      var catMode = mode === 'lc' || mode === 'lcdesc' ? 'usual' : mode;
      var cats = kids(nav, '.taxonomy-acc');
      reorder(nav, cats, catMode, nameOfAcc);
      kids(nav, '.taxonomy-acc').forEach(function (cat) {
        var subs = kids(cat, '.taxonomy-acc');
        reorder(cat, subs, catMode, nameOfAcc);
        kids(cat, '.taxonomy-acc').forEach(function (sub) {
          var list = sub.querySelector(':scope > .taxonomy-topics');
          if (!list) return;
          reorder(list, kids(list, 'li'), mode, nameOfTopic, lcOfTopic);
        });
      });
      if (tileList) {
        reorder(tileList, kids(tileList, '.content-tile'), mode, titleOfTile, lcOfTile);
      }
    }

    document.querySelectorAll('[data-browse-sort]').forEach(function (btn) {
      var panel = btn.closest('[data-pop-panel]');
      var nav = panel && panel.querySelector('.taxonomy');
      var root = panel && panel.closest('.browse');
      if (!panel || !nav) return;

      var tileList = root && root.querySelector('.content-tiles');
      var cats = kids(nav, '.taxonomy-acc');
      stamp(cats);
      cats.forEach(function (cat) {
        var subs = kids(cat, '.taxonomy-acc');
        stamp(subs);
        subs.forEach(function (sub) {
          var list = sub.querySelector(':scope > .taxonomy-topics');
          if (!list) return;
          stamp(kids(list, 'li'));
        });
      });
      if (tileList) stamp(kids(tileList, '.content-tile'));
      if (root) root.setAttribute('data-browse-sort-mode', 'usual');

      var modeIndex = 0;

      function setSortMode(mode, persist) {
        var idx = modes.indexOf(mode);
        modeIndex = idx < 0 ? 0 : idx;
        mode = modes[modeIndex];
        var label = btn.querySelector('[data-browse-sort-label]');
        btn.setAttribute('data-browse-sort', mode);
        btn.setAttribute('aria-label', spoken[mode]);
        if (label) label.textContent = labels[mode];
        if (root) root.setAttribute('data-browse-sort-mode', mode);
        applySort(nav, mode, tileList);
        if (root) syncBrowseIndicator(root);
        if (persist !== false) writeBrowsePersist({ sort: mode });
      }

      btn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        setSortMode(modes[(modeIndex + 1) % modes.length]);
      });

      var saved = readBrowsePersist();
      if (saved.sort !== 'usual') setSortMode(saved.sort, false);
      if (root && saved.q && typeof root._restoreBrowseSearch === 'function') {
        root._restoreBrowseSearch(saved.q);
      }
    });
  }

  initBrowseSort();

  document.querySelectorAll('[data-pop]').forEach(function (root) {
    var btn = root.querySelector('[data-pop-btn]');
    var panel = root.querySelector('[data-pop-panel]');
    if (!btn || !panel) return;

    function setOpen(open) {
      panel.hidden = !open;
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
      if (!open) closeFilterNested(panel);
      syncMenuLayer();
    }

    function closeAll() {
      document.querySelectorAll('[data-pop]').forEach(function (other) {
        var otherBtn = other.querySelector('[data-pop-btn]');
        var otherPanel = other.querySelector('[data-pop-panel]');
        if (otherBtn && otherPanel) {
          otherPanel.hidden = true;
          otherBtn.setAttribute('aria-expanded', 'false');
          closeFilterNested(otherPanel);
        }
      });
      syncMenuLayer();
    }

    btn.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      closeUserTagPickers();
      var willOpen = panel.hidden;
      closeAll();
      if (willOpen) setOpen(true);
    });

    panel.addEventListener('click', function (e) {
      e.stopPropagation();
    });

    document.addEventListener('click', function () {
      setOpen(false);
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeAll();
    });
  });

  var guideSelectRoot = document.querySelector('[data-guide-select]');
  var guideSelectMenu = document.getElementById('guide-select-menu');
  var guideGenModal = document.getElementById('guide-gen-modal');
  var guideGenPreview = document.getElementById('guide-gen-preview');
  var guideGenCopy = document.getElementById('guide-gen-copy');
  var guideGenDone = document.getElementById('guide-gen-modal-done');
  var guideGenChatgpt = document.getElementById('guide-gen-open-chatgpt');
  var guideGenClaude = document.getElementById('guide-gen-open-claude');
  var guideGenCursor = document.getElementById('guide-gen-open-cursor');
  var guideGenCursorNote = document.getElementById('guide-gen-cursor-note');
  var guideSelectGenerate = document.getElementById('guide-select-generate');
  var guideSelectCopy = document.getElementById('guide-select-copy');
  var guideAskModal = document.getElementById('guide-ask-modal');
  var guideAskHighlight = document.getElementById('guide-ask-highlight');
  var guideAskQuestion = document.getElementById('guide-ask-question');
  var guideAskPreview = document.getElementById('guide-ask-preview');
  var guideAskCopy = document.getElementById('guide-ask-copy');
  var guideAskDone = document.getElementById('guide-ask-modal-done');
  var guideAskChatgpt = document.getElementById('guide-ask-open-chatgpt');
  var guideAskClaude = document.getElementById('guide-ask-open-claude');
  var guideAskCursor = document.getElementById('guide-ask-open-cursor');
  var guideAskCursorNote = document.getElementById('guide-ask-cursor-note');
  var guideSelectAsk = document.getElementById('guide-select-ask');
  var lastGuideAskFocus = null;
  var savedGuideSelectionText = '';
  var savedGuideExplanation = '';
  var guideAskPassages = { selection: '', sentence: '', paragraph: '' };
  var guideAskPassageMode = 'selection';
  var guideAskExpandSentence = document.getElementById('guide-ask-expand-sentence');
  var guideAskExpandParagraph = document.getElementById('guide-ask-expand-paragraph');
  var lastGuideGenFocus = null;
  var guideSelectTimer = null;

  function guideClosestEl(node) {
    if (!node) return null;
    return node.nodeType === 1 ? node : node.parentElement;
  }

  function guideNodeIn(node, selector) {
    var el = guideClosestEl(node);
    return !!(el && el.closest && el.closest(selector));
  }

  function isUsableGuideSelection(sel) {
    if (!guideSelectRoot || !sel || sel.rangeCount === 0 || sel.isCollapsed) return false;
    var text = String(sel.toString() || '').trim();
    if (!text) return false;
    var range = sel.getRangeAt(0);
    if (!guideSelectRoot.contains(range.startContainer) || !guideSelectRoot.contains(range.endContainer)) {
      return false;
    }
    if (guideNodeIn(range.startContainer, '.ui-builder') && guideNodeIn(range.endContainer, '.ui-builder')) {
      return false;
    }
    return true;
  }

  function explanationThroughSelection(sel) {
    var title = guideSelectRoot ? String(guideSelectRoot.getAttribute('data-guide-title') || '').trim() : '';
    if (!sel || sel.rangeCount === 0) return title ? '# ' + title : '';
    var range = sel.getRangeAt(0);
    var collect = document.createRange();
    collect.selectNodeContents(guideSelectRoot);
    try {
      collect.setEnd(range.endContainer, range.endOffset);
    } catch (err) {
      return title ? '# ' + title : '';
    }
    var wrap = document.createElement('div');
    wrap.appendChild(collect.cloneContents());
    wrap.querySelectorAll('.ui-builder').forEach(function (el) {
      el.remove();
    });
    var plainPrefix = String(wrap.innerText || wrap.textContent || '').replace(/\s+/g, ' ').trim();
    var sourceMd = readGuideSourceMd();
    var body = '';
    if (sourceMd && plainPrefix) {
      body = cutMarkdownToPlainPrefix(sourceMd, plainPrefix);
    }
    if (!body) {
      body = htmlFragmentToMarkdown(wrap);
    }
    body = String(body || '').replace(/\n{3,}/g, '\n\n').trim();
    if (!title) return body;
    var heading = '# ' + title;
    if (!body) return heading;
    if (body.indexOf(heading) === 0) return body;
    return heading + '\n\n' + body;
  }

  function readGuideSourceMd() {
    var el = document.getElementById('guide-source-md');
    if (!el) return '';
    try {
      var parsed = JSON.parse(el.textContent || '""');
      return typeof parsed === 'string' ? parsed : '';
    } catch (err) {
      return '';
    }
  }

  function cutMarkdownToPlainPrefix(md, plainPrefix) {
    var target = String(plainPrefix || '').replace(/\s+/g, ' ').trim();
    if (!target) return '';
    var i = 0;
    var p = 0;
    var inFence = false;
    var n = md.length;

    function atLineStart(idx) {
      return idx === 0 || md.charAt(idx - 1) === '\n' || md.charAt(idx - 1) === '\r';
    }

    while (i < n && p < target.length) {
      if (atLineStart(i) && md.slice(i, i + 3) === '```') {
        inFence = !inFence;
        i += 3;
        while (i < n && md.charAt(i) !== '\n') i++;
        if (i < n && md.charAt(i) === '\n') i++;
        continue;
      }

      var mc = md.charAt(i);
      var pc = target.charAt(p);

      if (/\s/.test(mc)) {
        i++;
        if (/\s/.test(pc)) {
          while (p < target.length && /\s/.test(target.charAt(p))) p++;
        }
        continue;
      }

      if (/\s/.test(pc)) {
        p++;
        continue;
      }

      if (mc === pc) {
        i++;
        p++;
        continue;
      }

      if (!inFence) {
        if (atLineStart(i) && mc === '#') {
          while (i < n && md.charAt(i) === '#') i++;
          while (i < n && md.charAt(i) === ' ') i++;
          continue;
        }
        if (atLineStart(i) && (mc === '-' || mc === '*') && i + 1 < n && md.charAt(i + 1) === ' ') {
          i += 2;
          continue;
        }
        if (mc === '`' || mc === '*' || mc === '_') {
          i++;
          continue;
        }
      }

      break;
    }

    if (p < target.length * 0.85) return '';
    return md.slice(0, i).replace(/[ \t]+$/g, '').replace(/\n+$/g, '');
  }

  function htmlFragmentToMarkdown(root) {
    var blocks = [];

    function inlineMd(el) {
      var out = '';
      Array.prototype.forEach.call(el.childNodes, function (child) {
        if (child.nodeType === 3) {
          out += child.nodeValue;
          return;
        }
        if (child.nodeType !== 1) return;
        var tag = child.tagName.toLowerCase();
        var inner = inlineMd(child);
        if (tag === 'code') out += '`' + inner + '`';
        else if (tag === 'strong' || tag === 'b') out += '**' + inner + '**';
        else if (tag === 'em' || tag === 'i') out += '*' + inner + '*';
        else if (tag === 'br') out += '\n';
        else out += inner;
      });
      return out.replace(/[ \t]+\n/g, '\n').replace(/[ \t]{2,}/g, ' ');
    }

    function pushBlock(text) {
      var t = String(text || '').trim();
      if (t) blocks.push(t);
    }

    Array.prototype.forEach.call(root.childNodes, function walk(child) {
      if (child.nodeType === 3) {
        var loose = String(child.nodeValue || '').replace(/\s+/g, ' ').trim();
        if (loose) pushBlock(loose);
        return;
      }
      if (child.nodeType !== 1) return;
      if (child.classList && child.classList.contains('ui-builder')) return;
      var tag = child.tagName.toLowerCase();
      if (tag === 'h1' || tag === 'h2') pushBlock('# ' + inlineMd(child).trim());
      else if (tag === 'h3') pushBlock('## ' + inlineMd(child).trim());
      else if (tag === 'h4') pushBlock('### ' + inlineMd(child).trim());
      else if (tag === 'p') pushBlock(inlineMd(child).trim());
      else if (tag === 'ul' || tag === 'ol') {
        var items = [];
        Array.prototype.forEach.call(child.children, function (li, idx) {
          if (li.tagName.toLowerCase() !== 'li') return;
          var bullet = tag === 'ol' ? String(idx + 1) + '. ' : '- ';
          items.push(bullet + inlineMd(li).trim());
        });
        if (items.length) pushBlock(items.join('\n'));
      } else if (tag === 'pre') {
        var code = String(child.textContent || '').replace(/\n+$/g, '');
        pushBlock('```\n' + code + '\n```');
      } else {
        Array.prototype.forEach.call(child.childNodes, walk);
      }
    });

    return blocks.join('\n\n');
  }

  function buildGuideGenPrompt(explanation) {
    return [
      'Read this explanation to the end. At the last section, generate the code snippet it\'s talking about. If that code snippet wouldn\'t be optimized, do not optimize it. If the section appears to talk about more than one approach, ask User which approach they want before generating the code snippet.',
      '',
      'Explanation here:',
      '"""',
      explanation,
      '"""',
      '',
      '---',
      '',
      'After the code snippet, give fast facts to these items (no need to explain, just give the fact):',
      '',
      '## Fast Facts',
      '- What is time complexity?',
      '- What is space complexity?',
      '- What is the data structure(s)?',
      '',
      '---',
      '',
      'After that, offer user what they can ask (Echo back to user exactly):',
      '',
      '## Ask Me',
      '- Explain the time complexity',
      '- Explain the space complexity',
      '- Explain why use the data structure(s)',
      '',
      'Or if you want to be coached on the concept, then prompt me with:',
      '```',
      'Be my interactive coach for algorithm and coding-interview problems. Before solving, write a short roadmap in paragraph prose describing the questions you will guide me through: first testing my understanding of the question by repeating the explanation text and asking me to reply in my own wording what I think the problem is, then correcting me if needed; then understanding the input, output, and constraints; finding a simple baseline; identifying a useful pattern or data structure; deriving the algorithm; walking through an example; and checking time and space complexity. Then ask me only the first question.',
      '',
      'Start with that first step: repeat the explanation text and ask me to reply with my own wording of what I think the problem is. Tell me that if I am having a hard time, I can ask you to reword the problem for me. Correct me if needed before continuing. Guide me one step at a time and wait for my answer before moving on. Do not reveal the full solution, code, or later hints unless I ask for them or have completed the current step. If I am wrong or stuck, briefly explain why, give the smallest useful hint, and let me try again. Adapt the pace and explanations to my answers. Once I can explain the approach in my own words, help me write the JavaScript solution and then have me identify its time and space complexity.',
      '```',  
    ].join('\n');
  }

  function currentGuideGenPrompt() {
    return buildGuideGenPrompt(savedGuideExplanation);
  }

  function guideAskGuideText() {
    var title = guideSelectRoot ? String(guideSelectRoot.getAttribute('data-guide-title') || '').trim() : '';
    var source = readGuideSourceMd();
    var parts = [];
    if (title) parts.push('# ' + title);
    if (source) parts.push(source);
    return parts.join('\n\n').trim();
  }

  function askBlockEl(node) {
    var el = guideClosestEl(node);
    if (!el || !guideSelectRoot || !guideSelectRoot.contains(el)) return null;
    var block = el.closest('p, li, blockquote, pre, h1, h2, h3, h4, h5, h6, td, th, dd');
    if (!block || !guideSelectRoot.contains(block) || block === guideSelectRoot) return null;
    return block;
  }

  function textThroughBlockEnd(startContainer, startOffset, endBlock) {
    var range = document.createRange();
    range.setStart(startContainer, startOffset);
    var end = document.createRange();
    end.selectNodeContents(endBlock);
    range.setEnd(end.endContainer, end.endOffset);
    return range.toString();
  }

  function sentenceCut(text, fromIndex) {
    var i = fromIndex;
    while (i < text.length) {
      var ch = text.charAt(i);
      if (ch === '.' || ch === '!' || ch === '?') {
        var j = i + 1;
        while (j < text.length && /["')\]]/.test(text.charAt(j))) j++;
        if (j >= text.length || /\s/.test(text.charAt(j))) return j;
      }
      i++;
    }
    return text.length;
  }

  function selectionEndsSentence(text, fromIndex) {
    var i = fromIndex;
    while (i > 0 && /["')\]]/.test(text.charAt(i - 1))) i--;
    if (i <= 0) return false;
    var ch = text.charAt(i - 1);
    if (ch !== '.' && ch !== '!' && ch !== '?') return false;
    var after = fromIndex < text.length ? text.charAt(fromIndex) : '';
    return !after || /\s/.test(after);
  }

  function captureGuideAskPassages(sel) {
    var selection = String(sel && sel.toString ? sel.toString() : '').trim();
    var sentence = selection;
    var paragraph = selection;
    try {
      var range = sel.getRangeAt(0);
      var endBlock = askBlockEl(range.endContainer) || askBlockEl(range.startContainer);
      if (endBlock) {
        var through = textThroughBlockEnd(range.startContainer, range.startOffset, endBlock);
        var rawSel = range.toString();
        if (through.indexOf(rawSel) === 0) {
          paragraph = through.trim() || selection;
          var endAt = rawSel.length;
          var cut = selectionEndsSentence(through, endAt) ? endAt : sentenceCut(through, endAt);
          sentence = through.slice(0, cut).trim() || selection;
        }
      }
    } catch (err) {}
    guideAskPassages = {
      selection: selection,
      sentence: sentence || selection,
      paragraph: paragraph || selection
    };
  }

  function guideAskHighlightText() {
    if (guideAskPassageMode === 'sentence') return guideAskPassages.sentence || guideAskPassages.selection || savedGuideSelectionText;
    if (guideAskPassageMode === 'paragraph') return guideAskPassages.paragraph || guideAskPassages.selection || savedGuideSelectionText;
    return guideAskPassages.selection || savedGuideSelectionText;
  }

  function sameAskText(a, b) {
    return String(a || '').replace(/\s+/g, ' ').trim() === String(b || '').replace(/\s+/g, ' ').trim();
  }

  function syncGuideAskExpand() {
    var selection = guideAskPassages.selection || savedGuideSelectionText;
    if (guideAskExpandSentence) {
      var sentenceSame = sameAskText(guideAskPassages.sentence, selection);
      guideAskExpandSentence.disabled = sentenceSame;
      guideAskExpandSentence.setAttribute('aria-pressed', !sentenceSame && guideAskPassageMode === 'sentence' ? 'true' : 'false');
    }
    if (guideAskExpandParagraph) {
      var paragraphSame = sameAskText(guideAskPassages.paragraph, selection);
      guideAskExpandParagraph.disabled = paragraphSame;
      guideAskExpandParagraph.setAttribute('aria-pressed', !paragraphSame && guideAskPassageMode === 'paragraph' ? 'true' : 'false');
    }
    if (guideAskHighlight) guideAskHighlight.textContent = guideAskHighlightText();
  }

  function setGuideAskPassageMode(mode) {
    guideAskPassageMode = guideAskPassageMode === mode ? 'selection' : mode;
    syncGuideAskExpand();
    refreshGuideAskPreview();
  }

  function buildGuideAskPrompt(question) {
    var guide = guideAskGuideText();
    var q = String(question || '').trim();
    var highlight = String(guideAskHighlightText() || '').trim();
    var lines = [
      '## Question',
      q,
      '',
      '## Highlighted text',
      highlight,
      '',
      'Answer the question about the highlighted text. The guide after the divider is context.'
    ];
    if (guide) {
      lines.push('');
      lines.push('---');
      lines.push('');
      lines.push(guide);
    }
    return lines.join('\n');
  }

  function currentGuideAskPrompt() {
    return buildGuideAskPrompt(guideAskQuestion ? guideAskQuestion.value : '');
  }

  function hideGuideSelectMenu() {
    if (guideSelectMenu) guideSelectMenu.hidden = true;
  }

  function placeGuideSelectMenu(range) {
    if (!guideSelectMenu) return;
    var rect = range.getBoundingClientRect();
    guideSelectMenu.hidden = false;
    var menuRect = guideSelectMenu.getBoundingClientRect();
    var top = rect.top - menuRect.height - 8;
    if (top < 8) top = rect.bottom + 8;
    var left = rect.left + rect.width / 2 - menuRect.width / 2;
    var maxLeft = window.innerWidth - menuRect.width - 8;
    if (left < 8) left = 8;
    if (left > maxLeft) left = Math.max(8, maxLeft);
    guideSelectMenu.style.top = top + 'px';
    guideSelectMenu.style.left = left + 'px';
  }

  function captureGuideSelection(sel) {
    savedGuideSelectionText = String(sel.toString() || '').trim();
    captureGuideAskPassages(sel);
    try {
      savedGuideExplanation = explanationThroughSelection(sel);
    } catch (err) {
      savedGuideExplanation = savedGuideSelectionText;
    }
  }

  function guideModalIsOpen() {
    return (guideGenModal && !guideGenModal.hidden) || (guideAskModal && !guideAskModal.hidden);
  }

  function syncGuideModalBody() {
    document.body.classList.toggle('modal-open', guideModalIsOpen());
  }

  function syncGuideSelectMenu() {
    if (guideModalIsOpen()) {
      hideGuideSelectMenu();
      return;
    }
    var sel = window.getSelection();
    if (!isUsableGuideSelection(sel)) {
      hideGuideSelectMenu();
      return;
    }
    captureGuideSelection(sel);
    placeGuideSelectMenu(sel.getRangeAt(0));
  }

  function scheduleGuideSelectMenu() {
    clearTimeout(guideSelectTimer);
    guideSelectTimer = setTimeout(syncGuideSelectMenu, 80);
  }

  function setGuideGenCursorNoteOpen(open) {
    if (guideGenCursorNote) guideGenCursorNote.hidden = !open;
    if (guideGenCursor) guideGenCursor.setAttribute('aria-expanded', open ? 'true' : 'false');
  }

  function setGuideGenModalOpen(open) {
    if (!guideGenModal) return;
    guideGenModal.hidden = !open;
    syncGuideModalBody();
    if (open) {
      hideGuideSelectMenu();
      setGuideGenCursorNoteOpen(false);
      if (guideGenPreview) guideGenPreview.textContent = currentGuideGenPrompt();
      var panel = guideGenModal.querySelector('.modal__panel');
      if (panel && typeof panel.focus === 'function') panel.focus();
    } else if (lastGuideGenFocus && typeof lastGuideGenFocus.focus === 'function') {
      lastGuideGenFocus.focus();
    }
  }

  function copyGuideGenPrompt(done) {
    copyText(currentGuideGenPrompt()).then(function () {
      if (typeof done === 'function') done();
    }).catch(function () {
      if (typeof done === 'function') done();
    });
  }

  function openGuideGenService(url) {
    window.open(url, '_blank', 'noopener,noreferrer');
    copyGuideGenPrompt(function () {
      if (guideGenCopy) flashCopied(guideGenCopy);
    });
  }

  function refreshGuideAskPreview() {
    if (!guideAskPreview) return;
    guideAskPreview.textContent = currentGuideAskPrompt();
    guideAskPreview.scrollTop = 0;
  }

  function setGuideAskCursorNoteOpen(open) {
    if (guideAskCursorNote) guideAskCursorNote.hidden = !open;
    if (guideAskCursor) guideAskCursor.setAttribute('aria-expanded', open ? 'true' : 'false');
  }

  function setGuideAskModalOpen(open) {
    if (!guideAskModal) return;
    guideAskModal.hidden = !open;
    syncGuideModalBody();
    if (open) {
      hideGuideSelectMenu();
      setGuideAskCursorNoteOpen(false);
      guideAskPassageMode = 'selection';
      if (!guideAskPassages.selection) {
        guideAskPassages = {
          selection: savedGuideSelectionText,
          sentence: savedGuideSelectionText,
          paragraph: savedGuideSelectionText
        };
      }
      if (guideAskQuestion) guideAskQuestion.value = '';
      syncGuideAskExpand();
      refreshGuideAskPreview();
      if (guideAskQuestion && typeof guideAskQuestion.focus === 'function') guideAskQuestion.focus();
    } else if (lastGuideAskFocus && typeof lastGuideAskFocus.focus === 'function') {
      lastGuideAskFocus.focus();
    }
  }

  function copyGuideAskPrompt(done) {
    copyText(currentGuideAskPrompt()).then(function () {
      if (typeof done === 'function') done();
    }).catch(function () {
      if (typeof done === 'function') done();
    });
  }

  function openGuideAskService(url) {
    window.open(url, '_blank', 'noopener,noreferrer');
    copyGuideAskPrompt(function () {
      if (guideAskCopy) flashCopied(guideAskCopy);
    });
  }

  if (guideSelectRoot && guideSelectMenu && guideGenModal) {
    document.addEventListener('selectionchange', scheduleGuideSelectMenu);
    document.addEventListener('mouseup', scheduleGuideSelectMenu);
    document.addEventListener('keyup', function (e) {
      if (e.key === 'Shift' || e.key.indexOf('Arrow') === 0) scheduleGuideSelectMenu();
    });

    window.addEventListener('scroll', hideGuideSelectMenu, true);
    window.addEventListener('resize', hideGuideSelectMenu);

    document.addEventListener('mousedown', function (e) {
      if (guideSelectMenu.contains(e.target)) {
        e.preventDefault();
        return;
      }
      if (guideGenModal && !guideGenModal.hidden && guideGenModal.contains(e.target)) return;
      if (guideAskModal && !guideAskModal.hidden && guideAskModal.contains(e.target)) return;
      hideGuideSelectMenu();
    });

    if (guideSelectGenerate) {
      guideSelectGenerate.addEventListener('click', function () {
        lastGuideGenFocus = guideSelectGenerate;
        try {
          var sel = window.getSelection();
          if (isUsableGuideSelection(sel)) captureGuideSelection(sel);
        } catch (err) {}
        setGuideGenModalOpen(true);
      });
    }

    if (guideSelectAsk) {
      guideSelectAsk.addEventListener('click', function () {
        lastGuideAskFocus = guideSelectAsk;
        try {
          var sel = window.getSelection();
          if (isUsableGuideSelection(sel)) captureGuideSelection(sel);
        } catch (err) {}
        setGuideAskModalOpen(true);
      });
    }

    if (guideSelectCopy) {
      guideSelectCopy.addEventListener('click', function () {
        var text = savedGuideSelectionText;
        if (!text) {
          var sel = window.getSelection();
          text = sel ? String(sel.toString() || '').trim() : '';
        }
        if (!text) return;
        copyText(text).then(function () {
          flashCopied(guideSelectCopy);
        });
      });
    }

    var guideGenBackdrop = guideGenModal.querySelector('[data-action="close-guide-gen-modal"]');
    if (guideGenBackdrop) {
      guideGenBackdrop.addEventListener('click', function () {
        setGuideGenModalOpen(false);
      });
    }

    document.addEventListener('keydown', function (e) {
      if (e.key !== 'Escape') return;
      if (guideAskModal && !guideAskModal.hidden) {
        e.preventDefault();
        setGuideAskModalOpen(false);
        return;
      }
      if (guideGenModal && !guideGenModal.hidden) {
        e.preventDefault();
        setGuideGenModalOpen(false);
      }
    });

    if (guideGenDone) {
      guideGenDone.addEventListener('click', function () {
        setGuideGenModalOpen(false);
      });
    }

    if (guideGenCopy) {
      guideGenCopy.addEventListener('click', function () {
        copyGuideGenPrompt(function () {
          flashCopied(guideGenCopy);
        });
      });
    }

    if (guideGenChatgpt) {
      guideGenChatgpt.addEventListener('click', function (e) {
        e.preventDefault();
        openGuideGenService(guideGenChatgpt.href || 'https://chatgpt.com/');
      });
    }

    if (guideGenClaude) {
      guideGenClaude.addEventListener('click', function (e) {
        e.preventDefault();
        openGuideGenService(guideGenClaude.href || 'https://claude.ai/new');
      });
    }

    if (guideGenCursor) {
      guideGenCursor.addEventListener('click', function () {
        copyGuideGenPrompt(function () {
          if (guideGenCopy) flashCopied(guideGenCopy);
        });
        setGuideGenCursorNoteOpen(true);
      });
    }

    if (guideAskModal) {
      var guideAskBackdrop = guideAskModal.querySelector('[data-action="close-guide-ask-modal"]');
      if (guideAskBackdrop) {
        guideAskBackdrop.addEventListener('click', function () {
          setGuideAskModalOpen(false);
        });
      }

      if (guideAskDone) {
        guideAskDone.addEventListener('click', function () {
          setGuideAskModalOpen(false);
        });
      }

      if (guideAskQuestion) {
        guideAskQuestion.addEventListener('input', refreshGuideAskPreview);
      }

      if (guideAskExpandSentence) {
        guideAskExpandSentence.addEventListener('click', function () {
          setGuideAskPassageMode('sentence');
        });
      }

      if (guideAskExpandParagraph) {
        guideAskExpandParagraph.addEventListener('click', function () {
          setGuideAskPassageMode('paragraph');
        });
      }

      if (guideAskCopy) {
        guideAskCopy.addEventListener('click', function () {
          copyGuideAskPrompt(function () {
            flashCopied(guideAskCopy);
          });
        });
      }

      if (guideAskChatgpt) {
        guideAskChatgpt.addEventListener('click', function (e) {
          e.preventDefault();
          openGuideAskService(guideAskChatgpt.href || 'https://chatgpt.com/');
        });
      }

      if (guideAskClaude) {
        guideAskClaude.addEventListener('click', function (e) {
          e.preventDefault();
          openGuideAskService(guideAskClaude.href || 'https://claude.ai/new');
        });
      }

      if (guideAskCursor) {
        guideAskCursor.addEventListener('click', function () {
          copyGuideAskPrompt(function () {
            if (guideAskCopy) flashCopied(guideAskCopy);
          });
          setGuideAskCursorNoteOpen(true);
        });
      }
    }
  }

  /* ---------- Recent list (mirrors the YT app's History panel) ---------- */

  var RECENT_LS = 'algos-recent-v1';
  var RECENT_MAX = 500;
  var RECENT_FLUSH_MS = 15000;
  var RECENT_MAX_DELTA_MS = 120000;
  var RECENT_TYPE_LABELS = {
    guide: 'Algo Guide',
    game: 'Mini game',
    session: 'Step-by-step'
  };
  var RECENT_TYPE_ORDER = ['guide', 'game', 'session'];
  var recentSort = { key: '', dir: 'desc' };
  var recentFilter = { cat: '', type: '' };
  var recentCountSort = {
    cat: { key: '', dir: 'desc' },
    type: { key: '', dir: 'desc' }
  };

  function recentKey(type, slug) {
    return String(type) + ':' + String(slug);
  }

  function normalizeRecentEntry(raw) {
    if (!raw || typeof raw !== 'object') return null;
    var type = String(raw.type || '');
    var slug = String(raw.slug || '');
    if (!RECENT_TYPE_LABELS[type] || !slug) return null;
    var cats = [];
    if (Array.isArray(raw.categories)) {
      raw.categories.forEach(function (pair) {
        if (Array.isArray(pair) && pair[0]) {
          cats.push([String(pair[0]), String(pair[1] || 'General')]);
        }
      });
    }
    if (!cats.length) cats.push(['Uncategorized', 'General']);
    return {
      type: type,
      slug: slug,
      title: String(raw.title || slug),
      href: String(raw.href || ''),
      leetcode: Number(raw.leetcode) > 0 ? Number(raw.leetcode) : null,
      categories: cats,
      lastVisited: Number(raw.lastVisited) || 0,
      visits: Math.max(0, Number(raw.visits) || 0),
      totalMs: Math.max(0, Number(raw.totalMs) || 0),
      lastMs: Math.max(0, Number(raw.lastMs) || 0)
    };
  }

  function readRecent() {
    try {
      var parsed = JSON.parse(localStorage.getItem(RECENT_LS) || '[]');
      if (!Array.isArray(parsed)) return [];
      var out = [];
      parsed.forEach(function (raw) {
        var entry = normalizeRecentEntry(raw);
        if (entry) out.push(entry);
      });
      return out;
    } catch (e) {
      return [];
    }
  }

  function writeRecent(entries) {
    try {
      localStorage.setItem(RECENT_LS, JSON.stringify(entries.slice(0, RECENT_MAX)));
    } catch (e) {}
  }

  function findRecentIndex(entries, key) {
    for (var i = 0; i < entries.length; i++) {
      if (recentKey(entries[i].type, entries[i].slug) === key) return i;
    }
    return -1;
  }

  /* -- dwell tracking on a resource page -- */

  var recentPage = null;
  var recentActiveSince = null;

  function readRecentMarker() {
    var el = document.querySelector('[data-recent-visit]');
    if (!el) return null;
    try {
      return normalizeRecentEntry(JSON.parse(el.getAttribute('data-recent-visit') || 'null'));
    } catch (e) {
      return null;
    }
  }

  function recordRecentVisit() {
    if (!recentPage) return;
    var entries = readRecent();
    var key = recentKey(recentPage.type, recentPage.slug);
    var index = findRecentIndex(entries, key);
    var entry = index === -1 ? recentPage : entries[index];
    if (index !== -1) entries.splice(index, 1);
    entry.title = recentPage.title;
    entry.href = recentPage.href || entry.href;
    entry.leetcode = recentPage.leetcode;
    entry.categories = recentPage.categories;
    entry.lastVisited = Date.now();
    entry.visits = (entry.visits || 0) + 1;
    entry.lastMs = 0;
    entries.unshift(entry);
    writeRecent(entries);
  }

  function flushRecentDwell() {
    if (!recentPage || recentActiveSince === null) return;
    var now = Date.now();
    var delta = Math.min(Math.max(0, now - recentActiveSince), RECENT_MAX_DELTA_MS);
    recentActiveSince = now;
    if (delta < 250) return;
    var entries = readRecent();
    var index = findRecentIndex(entries, recentKey(recentPage.type, recentPage.slug));
    if (index === -1) return; // deleted while open: respect it until the next visit
    entries[index].totalMs += delta;
    entries[index].lastMs += delta;
    writeRecent(entries);
    syncOpenRecentRow(entries[index]);
  }

  function pauseRecentDwell() {
    flushRecentDwell();
    recentActiveSince = null;
  }

  function resumeRecentDwell() {
    if (!recentPage || document.visibilityState === 'hidden') return;
    if (recentActiveSince === null) recentActiveSince = Date.now();
  }

  function initRecentTracking() {
    recentPage = readRecentMarker();
    if (!recentPage) return;
    recordRecentVisit();
    resumeRecentDwell();

    document.addEventListener('visibilitychange', function () {
      if (document.visibilityState === 'hidden') pauseRecentDwell();
      else resumeRecentDwell();
    });
    window.addEventListener('pagehide', pauseRecentDwell);
    window.addEventListener('beforeunload', pauseRecentDwell);
    window.addEventListener('pageshow', function (e) {
      if (e.persisted) {
        recordRecentVisit();
        recentActiveSince = null;
        resumeRecentDwell();
      }
    });
    window.setInterval(function () {
      if (document.visibilityState !== 'hidden') flushRecentDwell();
    }, RECENT_FLUSH_MS);
  }

  /* -- formatting -- */

  function pad2(n) {
    return (n < 10 ? '0' : '') + n;
  }

  function formatRecentDate(ts) {
    if (!ts) return '—';
    var d = new Date(ts);
    return d.getFullYear() + '.' + pad2(d.getMonth() + 1) + '.' + pad2(d.getDate());
  }

  function formatRecentClock(ts) {
    if (!ts) return '';
    var d = new Date(ts);
    var h = d.getHours();
    var ampm = h >= 12 ? 'PM' : 'AM';
    h = h % 12 || 12;
    return h + ':' + pad2(d.getMinutes()) + ' ' + ampm;
  }

  function formatRecentDuration(ms) {
    var total = Math.max(0, Math.floor((Number(ms) || 0) / 1000));
    var h = Math.floor(total / 3600);
    var m = Math.floor((total % 3600) / 60);
    var s = total % 60;
    if (h > 0) return h + 'h ' + m + 'm';
    if (m > 0) return m + 'm ' + (s ? s + 's' : '');
    return s + 's';
  }

  function recentTimeTitle(entry) {
    var visits = entry.visits || 0;
    return visits + (visits === 1 ? ' visit' : ' visits') +
      ' · last visit ' + formatRecentDuration(entry.lastMs).trim() +
      ' · total ' + formatRecentDuration(entry.totalMs).trim();
  }

  /* -- category counts (same Category / Subcategory taxonomy as the Filter dropdown) -- */

  function natCompare(a, b) {
    return String(a).localeCompare(String(b), undefined, { numeric: true, sensitivity: 'base' });
  }

  function recentCatValue(cat, sub) {
    return sub === undefined ? 'c:' + cat : 's:' + cat + '\u0001' + sub;
  }

  function entryMatchesCat(entry, value) {
    if (!value) return true;
    return entry.categories.some(function (pair) {
      if (value.indexOf('c:') === 0) return pair[0].toLowerCase() === value.slice(2).toLowerCase();
      return recentCatValue(pair[0], pair[1]).toLowerCase() === value.toLowerCase();
    });
  }

  function entryMatchesType(entry, type) {
    return !type || entry.type === type;
  }

  function recentCategoryTree(entries) {
    var cats = {};
    entries.forEach(function (entry) {
      var seenCat = {};
      var seenSub = {};
      entry.categories.forEach(function (pair) {
        var catId = pair[0].toLowerCase();
        var subId = catId + '\u0001' + pair[1].toLowerCase();
        if (!cats[catId]) cats[catId] = { name: pair[0], n: 0, ms: 0, subs: {} };
        var cat = cats[catId];
        if (!seenCat[catId]) {
          seenCat[catId] = true;
          cat.n += 1;
          cat.ms += entry.totalMs;
        }
        if (!cat.subs[subId]) cat.subs[subId] = { name: pair[1], n: 0, ms: 0 };
        if (!seenSub[subId]) {
          seenSub[subId] = true;
          cat.subs[subId].n += 1;
          cat.subs[subId].ms += entry.totalMs;
        }
      });
    });
    return Object.keys(cats).map(function (id) {
      var cat = cats[id];
      var subs = Object.keys(cat.subs).map(function (sid) {
        return cat.subs[sid];
      }).sort(function (a, b) {
        return natCompare(a.name, b.name);
      });
      return { name: cat.name, n: cat.n, ms: cat.ms, subs: subs };
    }).sort(function (a, b) {
      return natCompare(a.name, b.name);
    });
  }

  function makeOption(value, label, selected) {
    var opt = document.createElement('option');
    opt.value = value;
    opt.textContent = label;
    if (selected) opt.selected = true;
    return opt;
  }

  function renderRecentFilters(entries) {
    var catSelect = document.getElementById('recent-filter-cat');
    var typeSelect = document.getElementById('recent-filter-type');
    if (!catSelect || !typeSelect) return;

    // Categories are counted within the chosen type, and types within the chosen category.
    var forCats = entries.filter(function (entry) {
      return entryMatchesType(entry, recentFilter.type);
    });
    var forTypes = entries.filter(function (entry) {
      return entryMatchesCat(entry, recentFilter.cat);
    });
    var tree = recentCategoryTree(forCats);

    var stillThere = !recentFilter.cat;
    catSelect.innerHTML = '';
    catSelect.appendChild(makeOption('', 'All categories', !recentFilter.cat));
    tree.forEach(function (cat) {
      var group = document.createElement('optgroup');
      group.label = cat.name;
      var catValue = recentCatValue(cat.name);
      if (catValue.toLowerCase() === recentFilter.cat.toLowerCase()) stillThere = true;
      group.appendChild(makeOption(catValue, 'All ' + cat.name, catValue.toLowerCase() === recentFilter.cat.toLowerCase()));
      cat.subs.forEach(function (sub) {
        var subValue = recentCatValue(cat.name, sub.name);
        var current = subValue.toLowerCase() === recentFilter.cat.toLowerCase();
        if (current) stillThere = true;
        group.appendChild(makeOption(subValue, sub.name, current));
      });
      catSelect.appendChild(group);
    });
    if (!stillThere) {
      // Keep the chosen category visible even when nothing matches it right now.
      catSelect.appendChild(makeOption(recentFilter.cat, recentFilter.cat.replace(/^[cs]:/, '').replace('\u0001', ' / '), true));
    }

    typeSelect.innerHTML = '';
    typeSelect.appendChild(makeOption('', 'All resource types', !recentFilter.type));
    RECENT_TYPE_ORDER.forEach(function (type) {
      typeSelect.appendChild(makeOption(type, RECENT_TYPE_LABELS[type], recentFilter.type === type));
    });

    renderRecentCountTables(tree, forTypes);
  }

  function compareRecentCount(a, b, sort) {
    var dir = sort.key ? (sort.dir === 'asc' ? 1 : -1) : 1;
    if (!sort.key || sort.key === 'name') return natCompare(a.name, b.name) * dir;
    var av = sort.key === 'time' ? a.ms : a.n;
    var bv = sort.key === 'time' ? b.ms : b.n;
    if (av === bv) return natCompare(a.name, b.name);
    return av < bv ? -dir : dir;
  }

  function sortRecentCountRows(rows, sort) {
    return rows.slice().sort(function (a, b) {
      return compareRecentCount(a, b, sort);
    });
  }

  function recentCountRow(value, name, n, ms, kind, attr) {
    var tr = document.createElement('tr');
    tr.className = 'recent-count__row' + (kind === 'sub' ? ' recent-count__row--sub' : '');
    tr.setAttribute(attr, value);
    var current = attr === 'data-recent-cat'
      ? value.toLowerCase() === recentFilter.cat.toLowerCase()
      : value === recentFilter.type;
    if (current) tr.classList.add('is-current');
    var th = document.createElement('th');
    th.scope = 'row';
    var btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'recent-count__name recent-count__name--' + (kind === 'sub' ? 'sub' : 'cat');
    btn.textContent = name;
    btn.title = 'Show only ' + name;
    th.appendChild(btn);
    var count = document.createElement('td');
    count.className = 'recent-count__n';
    count.textContent = String(n);
    var time = document.createElement('td');
    time.className = 'recent-count__time';
    time.textContent = formatRecentDuration(ms).trim();
    tr.appendChild(th);
    tr.appendChild(count);
    tr.appendChild(time);
    return tr;
  }

  function renderRecentCountTables(tree, forTypes) {
    var catList = document.getElementById('recent-cat-counts');
    var typeList = document.getElementById('recent-type-counts');
    syncCountSortHeaders(document.getElementById('recent-cat-table'), recentCountSort.cat);
    syncCountSortHeaders(document.getElementById('recent-type-table'), recentCountSort.type);
    if (catList) {
      catList.innerHTML = '';
      var cats = sortRecentCountRows(tree, recentCountSort.cat);
      if (!cats.length) {
        var none = document.createElement('tr');
        var cell = document.createElement('td');
        cell.colSpan = 3;
        cell.className = 'recent-count__none';
        cell.textContent = 'No categories yet.';
        none.appendChild(cell);
        catList.appendChild(none);
      }
      cats.forEach(function (cat) {
        catList.appendChild(recentCountRow(recentCatValue(cat.name), cat.name, cat.n, cat.ms, 'cat', 'data-recent-cat'));
        sortRecentCountRows(cat.subs, recentCountSort.cat).forEach(function (sub) {
          catList.appendChild(recentCountRow(recentCatValue(cat.name, sub.name), sub.name, sub.n, sub.ms, 'sub', 'data-recent-cat'));
        });
      });
    }
    if (typeList) {
      typeList.innerHTML = '';
      var typeRows = RECENT_TYPE_ORDER.map(function (type) {
        var matched = forTypes.filter(function (entry) {
          return entry.type === type;
        });
        return {
          type: type,
          name: RECENT_TYPE_LABELS[type],
          n: matched.length,
          ms: matched.reduce(function (sum, entry) {
            return sum + entry.totalMs;
          }, 0)
        };
      });
      sortRecentCountRows(typeRows, recentCountSort.type).forEach(function (row) {
        typeList.appendChild(recentCountRow(row.type, row.name, row.n, row.ms, 'cat', 'data-recent-type'));
      });
    }
  }

  /* -- panel rendering -- */

  function isRecentOpen() {
    var root = document.getElementById('recent-root');
    return !!root && root.classList.contains('is-open');
  }

  function sortRecentEntries(entries) {
    if (!recentSort.key) return entries;
    var dir = recentSort.dir === 'asc' ? 1 : -1;
    return entries.slice().sort(function (a, b) {
      if (recentSort.key === 'name') return natCompare(a.title, b.title) * dir;
      var av = recentSort.key === 'time' ? a.totalMs : a.lastVisited;
      var bv = recentSort.key === 'time' ? b.totalMs : b.lastVisited;
      if (av === bv) return 0;
      return av < bv ? -dir : dir;
    });
  }

  function syncCountSortHeaders(table, sort) {
    if (!table) return;
    table.querySelectorAll('.recent-sort').forEach(function (btn) {
      var key = btn.getAttribute('data-sort');
      var active = sort.key === key;
      var th = btn.closest('th');
      if (th) th.setAttribute('aria-sort', active ? (sort.dir === 'asc' ? 'ascending' : 'descending') : 'none');
      var icon = btn.querySelector('.recent-sort__icon');
      if (icon) icon.textContent = active ? (sort.dir === 'asc' ? '↑' : '↓') : '↕';
    });
  }

  function syncRecentSortHeaders() {
    syncCountSortHeaders(document.getElementById('recent-table'), recentSort);
  }

  function toggleRecentCountSort(sort, key) {
    if (sort.key === key) {
      sort.dir = sort.dir === 'desc' ? 'asc' : 'desc';
      return;
    }
    sort.key = key;
    sort.dir = key === 'name' ? 'asc' : 'desc';
  }

  function updateRecentCountBadge(entries) {
    var badge = document.querySelector('[data-recent-count]');
    if (!badge) return;
    var list = entries || readRecent();
    badge.textContent = String(list.length);
    badge.hidden = list.length === 0;
  }

  function renderRecent() {
    var all = readRecent();
    updateRecentCountBadge(all);
    var rows = document.getElementById('recent-rows');
    var empty = document.getElementById('recent-empty');
    var table = document.getElementById('recent-table');
    var summary = document.getElementById('recent-summary');
    var clearAll = document.getElementById('recent-clear-all');
    if (!rows || !empty || !table) return;

    renderRecentFilters(all);
    var filtering = !!(recentFilter.cat || recentFilter.type);
    var entries = sortRecentEntries(all.filter(function (entry) {
      return entryMatchesCat(entry, recentFilter.cat) && entryMatchesType(entry, recentFilter.type);
    }));
    syncRecentSortHeaders();

    if (clearAll) clearAll.textContent = filtering ? 'Clear shown (' + entries.length + ')' : 'Clear all';
    if (summary) {
      var totalMs = entries.reduce(function (sum, entry) {
        return sum + entry.totalMs;
      }, 0);
      summary.textContent = all.length
        ? entries.length + (entries.length === 1 ? ' item' : ' items') +
          (filtering ? ' of ' + all.length : '') + ' · ' + formatRecentDuration(totalMs).trim() + ' total'
        : '';
    }

    rows.innerHTML = '';
    if (!entries.length) {
      empty.textContent = all.length
        ? 'Nothing recent matches that filter.'
        : 'Nothing visited yet. Open an Algo Guide, mini game, or Step-by-step session.';
      empty.hidden = false;
      table.hidden = true;
      return;
    }
    empty.hidden = true;
    table.hidden = false;

    entries.forEach(function (entry) {
      var tr = document.createElement('tr');
      tr.className = 'recent-row';
      tr.setAttribute('data-recent-key', recentKey(entry.type, entry.slug));

      var nameTd = document.createElement('td');
      var link = document.createElement('a');
      link.className = 'recent-name';
      link.href = entry.href || '#';
      link.textContent = entry.title;
      nameTd.appendChild(link);
      var meta = document.createElement('div');
      meta.className = 'recent-row-meta';
      var badge = document.createElement('span');
      badge.className = 'recent-type recent-type--' + entry.type;
      badge.textContent = RECENT_TYPE_LABELS[entry.type];
      meta.appendChild(badge);
      if (entry.leetcode) {
        var lc = document.createElement('span');
        lc.className = 'recent-lc';
        lc.textContent = '#' + entry.leetcode;
        meta.appendChild(lc);
      }
      var cats = document.createElement('span');
      cats.className = 'recent-row-cats';
      cats.textContent = entry.categories.map(function (pair) {
        return pair[0] + ' / ' + pair[1];
      }).join(', ');
      meta.appendChild(cats);
      nameTd.appendChild(meta);
      tr.appendChild(nameTd);

      var dateTd = document.createElement('td');
      dateTd.className = 'recent-date-cell';
      var time = document.createElement('time');
      time.className = 'recent-date';
      if (entry.lastVisited) time.setAttribute('datetime', new Date(entry.lastVisited).toISOString());
      time.textContent = formatRecentDate(entry.lastVisited);
      var clock = document.createElement('span');
      clock.className = 'recent-clock';
      clock.textContent = formatRecentClock(entry.lastVisited);
      time.appendChild(clock);
      dateTd.appendChild(time);
      tr.appendChild(dateTd);

      var timeTd = document.createElement('td');
      timeTd.className = 'recent-time-cell';
      timeTd.title = recentTimeTitle(entry);
      var dur = document.createElement('span');
      dur.className = 'recent-time';
      dur.textContent = formatRecentDuration(entry.totalMs).trim();
      var visits = document.createElement('span');
      visits.className = 'recent-visits';
      visits.textContent = entry.visits + (entry.visits === 1 ? ' visit' : ' visits');
      timeTd.appendChild(dur);
      timeTd.appendChild(visits);
      tr.appendChild(timeTd);

      var delTd = document.createElement('td');
      delTd.className = 'recent-delete-cell';
      var del = document.createElement('button');
      del.type = 'button';
      del.className = 'recent-delete';
      del.title = 'Delete this entry';
      del.setAttribute('aria-label', 'Delete ' + entry.title);
      del.innerHTML = '<span aria-hidden="true">✕</span>';
      delTd.appendChild(del);
      tr.appendChild(delTd);

      rows.appendChild(tr);
    });
  }

  function syncOpenRecentRow(entry) {
    if (!isRecentOpen()) return;
    if (recentSort.key === 'time' || recentFilter.cat || recentFilter.type) {
      renderRecent();
      return;
    }
    var key = recentKey(entry.type, entry.slug);
    var row = null;
    document.querySelectorAll('#recent-rows .recent-row').forEach(function (tr) {
      if (tr.getAttribute('data-recent-key') === key) row = tr;
    });
    if (!row) {
      renderRecent();
      return;
    }
    var cell = row.querySelector('.recent-time-cell');
    var dur = row.querySelector('.recent-time');
    var visits = row.querySelector('.recent-visits');
    if (cell) cell.title = recentTimeTitle(entry);
    if (dur) dur.textContent = formatRecentDuration(entry.totalMs).trim();
    if (visits) visits.textContent = entry.visits + (entry.visits === 1 ? ' visit' : ' visits');
  }

  function deleteRecentEntry(key) {
    writeRecent(readRecent().filter(function (entry) {
      return recentKey(entry.type, entry.slug) !== key;
    }));
    renderRecent();
  }

  function clearRecent(onlyShown) {
    if (onlyShown) {
      writeRecent(readRecent().filter(function (entry) {
        return !(entryMatchesCat(entry, recentFilter.cat) && entryMatchesType(entry, recentFilter.type));
      }));
    } else {
      writeRecent([]);
    }
    closeRecentMenu();
    renderRecent();
  }

  function closeRecentMenu() {
    var menu = document.getElementById('recent-menu');
    var toggle = document.getElementById('recent-menu-toggle');
    if (menu) menu.hidden = true;
    if (toggle) toggle.setAttribute('aria-expanded', 'false');
  }

  function openRecentPanel() {
    closeRecentMenu();
    flushRecentDwell();
    renderRecent();
    var root = document.getElementById('recent-root');
    if (!root) return;
    root.setAttribute('aria-hidden', 'false');
    root.classList.add('is-closing');
    window.requestAnimationFrame(function () {
      root.classList.add('is-open');
    });
    var open = document.getElementById('recent-open');
    if (open) open.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden';
    var close = document.getElementById('recent-close');
    if (close) close.focus();
  }

  function closeRecentPanel() {
    var root = document.getElementById('recent-root');
    if (!root || !root.classList.contains('is-open')) return;
    root.classList.remove('is-open');
    var open = document.getElementById('recent-open');
    if (open) open.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
    var panel = root.querySelector('.recent-panel');
    var finished = false;
    var done = function () {
      if (finished || root.classList.contains('is-open')) return;
      finished = true;
      root.classList.remove('is-closing');
      root.setAttribute('aria-hidden', 'true');
    };
    if (panel) panel.addEventListener('transitionend', done, { once: true });
    window.setTimeout(done, 360);
    if (open) open.focus();
  }

  function initRecentPanel() {
    var openBtn = document.getElementById('recent-open');
    if (!openBtn) return;
    updateRecentCountBadge();

    openBtn.addEventListener('click', openRecentPanel);
    var toggle = document.getElementById('recent-menu-toggle');
    var menu = document.getElementById('recent-menu');
    if (toggle && menu) {
      toggle.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        if (menu.hidden) {
          menu.hidden = false;
          toggle.setAttribute('aria-expanded', 'true');
        } else {
          closeRecentMenu();
        }
      });
    }
    var clearItem = document.getElementById('recent-clear');
    if (clearItem) {
      clearItem.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        if (!window.confirm('Clear recent?')) return;
        clearRecent(false);
      });
    }
    ['recent-backdrop', 'recent-close'].forEach(function (id) {
      var el = document.getElementById(id);
      if (el) el.addEventListener('click', closeRecentPanel);
    });

    var advanced = document.getElementById('recent-advanced');
    if (advanced) {
      advanced.addEventListener('change', function () {
        var table = document.getElementById('recent-table');
        var footer = document.getElementById('recent-footer');
        if (table) table.classList.toggle('is-advanced', advanced.checked);
        if (footer) footer.classList.toggle('is-advanced', advanced.checked);
      });
    }
    var clearAll = document.getElementById('recent-clear-all');
    if (clearAll) {
      clearAll.addEventListener('click', function () {
        var footer = document.getElementById('recent-footer');
        if (!footer || !footer.classList.contains('is-advanced')) return;
        var filtering = !!(recentFilter.cat || recentFilter.type);
        if (!window.confirm(filtering ? 'Clear the recent entries shown by this filter?' : 'Clear all recently visited?')) return;
        clearRecent(filtering);
      });
    }

    var catSelect = document.getElementById('recent-filter-cat');
    if (catSelect) {
      catSelect.addEventListener('change', function () {
        recentFilter.cat = catSelect.value;
        renderRecent();
      });
    }
    var typeSelect = document.getElementById('recent-filter-type');
    if (typeSelect) {
      typeSelect.addEventListener('change', function () {
        recentFilter.type = typeSelect.value;
        renderRecent();
      });
    }
    function bindRecentCountTable(table, sort, pick) {
      if (!table) return;
      table.addEventListener('click', function (e) {
        var sortBtn = e.target.closest('.recent-sort');
        if (sortBtn && table.contains(sortBtn)) {
          toggleRecentCountSort(sort, sortBtn.getAttribute('data-sort'));
          renderRecent();
          return;
        }
        var row = e.target.closest('tr');
        if (!row || !table.contains(row)) return;
        pick(row);
      });
    }
    bindRecentCountTable(document.getElementById('recent-cat-table'), recentCountSort.cat, function (row) {
      var value = row.getAttribute('data-recent-cat') || '';
      if (!value) return;
      recentFilter.cat = recentFilter.cat.toLowerCase() === value.toLowerCase() ? '' : value;
      renderRecent();
    });
    bindRecentCountTable(document.getElementById('recent-type-table'), recentCountSort.type, function (row) {
      var value = row.getAttribute('data-recent-type') || '';
      if (!value) return;
      recentFilter.type = recentFilter.type === value ? '' : value;
      renderRecent();
    });

    var table = document.getElementById('recent-table');
    if (table) {
      table.addEventListener('click', function (e) {
        var sortBtn = e.target.closest('.recent-sort');
        if (sortBtn) {
          var key = sortBtn.getAttribute('data-sort');
          if (recentSort.key === key) {
            recentSort.dir = recentSort.dir === 'desc' ? 'asc' : 'desc';
          } else {
            recentSort.key = key;
            recentSort.dir = key === 'name' ? 'asc' : 'desc';
          }
          renderRecent();
          return;
        }
        var del = e.target.closest('.recent-delete');
        if (del) {
          e.preventDefault();
          if (!table.classList.contains('is-advanced')) return;
          var row = del.closest('tr');
          if (!row) return;
          var name = row.querySelector('.recent-name');
          var title = name ? name.textContent.trim() : '';
          if (!window.confirm('Delete ' + (title ? '"' + title + '"' : 'this entry') + ' from Recent?')) return;
          deleteRecentEntry(row.getAttribute('data-recent-key') || '');
        }
      });
    }

    document.addEventListener('click', function (e) {
      if (!e.target.closest('[data-recent-split]')) closeRecentMenu();
    });
    document.addEventListener('keydown', function (e) {
      if (e.key !== 'Escape') return;
      if (menu && !menu.hidden) {
        closeRecentMenu();
        if (toggle) toggle.focus();
        return;
      }
      if (isRecentOpen()) closeRecentPanel();
    });
    window.addEventListener('storage', function (e) {
      if (e.key !== RECENT_LS) return;
      if (isRecentOpen()) renderRecent();
      else updateRecentCountBadge();
    });
  }

  /* -- Curated lists page: mark problems visited (any Recent entry with that LeetCode number) -- */

  function initCuratedListProgress() {
    var root = document.querySelector('[data-clist]');
    if (!root) return;

    function paint() {
      var visited = {};
      readRecent().forEach(function (entry) {
        if (entry.leetcode) visited[entry.leetcode] = true;
      });
      var done = 0;
      var items = root.querySelectorAll('.clist-item[data-leetcode]');
      items.forEach(function (item) {
        var on = !!visited[item.getAttribute('data-leetcode')];
        item.classList.toggle('is-visited', on);
        var check = item.querySelector('[data-clist-check]');
        if (check) check.title = on ? 'Visited (from Recent)' : 'Not visited yet';
        if (on) done++;
      });
      root.querySelectorAll('[data-clist-group]').forEach(function (group) {
        var all = group.querySelectorAll('.clist-item[data-leetcode]');
        var seen = group.querySelectorAll('.clist-item.is-visited');
        var label = group.querySelector('[data-clist-group-progress]');
        if (!label) return;
        label.textContent = seen.length + '/' + all.length + ' visited';
        label.hidden = false;
        label.classList.toggle('is-complete', all.length > 0 && seen.length === all.length);
      });
      var progress = root.querySelector('[data-clist-progress]');
      if (progress) {
        var total = Number(root.getAttribute('data-clist-total')) || items.length;
        // On a pattern filter only that pattern's rows are on the page, so count against what is shown.
        progress.innerHTML = '';
        var strong = document.createElement('strong');
        strong.textContent = done + '/' + items.length;
        progress.appendChild(strong);
        progress.appendChild(document.createTextNode(' visited' + (items.length !== total ? ' in this pattern' : '')));
        progress.hidden = false;
      }
    }

    paint();
    window.addEventListener('storage', function (e) {
      if (e.key === RECENT_LS) paint();
    });
    window.addEventListener('pageshow', function (e) {
      if (e.persisted) paint();
    });
  }

  initRecentTracking();
  initRecentPanel();
  initCuratedListProgress();
})();
