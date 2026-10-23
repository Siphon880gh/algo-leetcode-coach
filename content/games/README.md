# Mini games

All 3,042 qualifying Algo Guides have a mini game, chosen by the criteria in [`docs/mini-game-criteria.md`](../../docs/mini-game-criteria.md). Every guide (3,483) was scored on its own against the loosened criteria; the per-guide scores, reasons and build status are in [`docs/mini-game-scores.md`](../../docs/mini-game-scores.md). The criteria file starts with a note telling agents to use the loosened rules; the original strict rules stay below it, marked "reference only".

A game is not a quiz about the answer. The player performs the algorithm one decision at a time on a small random input, and every wrong move is explained.

## What qualified

- 3,042 games: 153 from the original strict pass and 2,889 built from the loosened criteria.
- Biggest groups: dynamic programming 442, math 241, greedy 224, tree 211, strings 191, binary search 183, graph 163, two pointers 140 and design 135. The rest are spread across 17 smaller patterns (the full breakdown is at the top of the scores file).

## What didn't qualify (441)

SQL (303), JavaScript API (67), Pandas (15), concurrency (9), shell (4), pure one-line formulas such as Bulb Switcher (16), brainteasers (6), and 20 guides that scored 7 out of 12. The one remaining entry, `add-mini-game`, isn't an algorithm guide.

## Layout

```
content/games/
  _engine/
    engine.js          shared runtime: seeded random inputs, steps, panels, lives, scoring, LCGame.mount()
    engine.css         game styles
    patterns/*.js      17 pattern files with the original hand-written games (LCGame.register)
    def.js             compact definition layer (LCGame.def / D) used by v2
    v2/{family}-NN.js  87 files with 2,889 definitions, grouped by pattern family
  {guide-slug}-game/   one folder per game: meta.php + index.html
  two-sum-pointers/    the original standalone Two Sum game
```

- `meta.php` returns the game's metadata: `title`, `leetcode` (the problem number), `difficulty`, `summary`, `category`, `subcategory` (the label on the Mini Games page), `topic`, `tags`, `entry` (`index.html`), `related_guide` and, when a coaching session exists, `related_session`.
- `index.html` loads `engine.css`, `engine.js`, and either one pattern file or `def.js` plus one v2 file. It then calls `LCGame.mount(document.getElementById('game'), '{guide-slug}')`. There is no build step and there are no dependencies.
- A v2 definition is `D('{guide-slug}', { t, r, g, s, ... })`:
  - `t`: the title.
  - `r`: the rule shown above the board.
  - `g(R)`: a random small input that uses LeetCode's parameter names.
  - `s(I, T)`: the real solution. It returns the LeetCode answer and asks questions through the tracker `T` (`T.at` sets the board, then `T.n`, `T.c`, `T.yn` or `T.k` ask for a move).
  - Optional keys: `cmp` (`'float'`, `'set'`, `'sets'` or a function, for problems that accept more than one answer), `exIn` (adapts a statement example's input), and `ex: false` (no checkable examples).
  - The full API is documented at the top of `_engine/def.js`.

## Links to guides and sessions

Games, guides and sessions find each other through `companion_existing_slug()` in `includes/content.php`. It tries the `related_*` key first, then the item's own slug, then the LeetCode number in `meta.php`. A guide `foo` therefore finds `foo-game` by its `leetcode` number, and the game points back with `related_guide` / `related_session`. Locked premium guides and sessions return 404 by design, and their statements never appear in game pages.

## Problem panel

`games/play.php` shows a collapsible "Problem: N. Title" panel above the game frame, open on load (`render_game_problem()`). It uses the stored statement from `includes/problem.php`: `content/problems/{n}.html`, or the gitignored `content/problems/premium/{n}.php` when it exists locally. Images and examples are included, with links to LeetCode and the Algo Guide. A premium problem without a local statement shows a short notice instead, and the game's dark setup line shows each round's input.

## Adding a game

1. Make sure the guide exists at `content/guides/{slug}/` and qualifies under the loosened criteria. Add or update its row in `docs/mini-game-scores.md`.
2. Add `D('{slug}', { ... })` to the matching `_engine/v2/{family}-NN.js`, or start a new file (`{family}-NN.js`, about 20 to 40 definitions each). Keep inputs small enough to fit on one screen, and make every wrong move explainable.
3. Test it: `node scripts/mini-games/test-games.js {family}-NN --slug={slug} --seeds=80`
4. Generate the folder: `node scripts/mini-games/new-game.js {slug}`. This writes `meta.php` and `index.html`, takes the LeetCode number from the guide, and refuses to overwrite an existing folder unless you pass `--force`; `--dry-run` prints the files instead.
5. Run the page and link checks below, then open `/games/play.php?id={slug}-game` to play it.

## Running the checks

The scripts in [`scripts/mini-games/`](../../scripts/mini-games/) need only Node and PHP. Run them from the repo root.

| Check | Command | What it verifies |
|---|---|---|
| Game logic (oracle) | `node scripts/mini-games/test-games.js [file-prefix] [--slug=x] [--seeds=N] [--quiet]` | Every v2 definition builds rounds on N random seeds (default 40); every step has a correct answer, wrong choices explain why, and panels are valid. `s()` also reproduces the expected output of the problem statement's own examples. |
| PHP syntax | `for f in content/games/*/meta.php; do php -l "$f"; done` | Every `meta.php` parses. |
| Pages | `php -S 127.0.0.1:8765` in one terminal, then `php scripts/mini-games/check-pages.php [base-url]` | Every game page returns 200 with no PHP error output and shows the problem panel: the statement, its images and the guide link, or the premium notice with nothing leaked. |
| Links | `php scripts/mini-games/check-links.php` | Every game resolves from its guide and session through the site's own lookup. This takes a few minutes. |

`scripts/mini-games/examples.js <n>` prints the examples parsed from problem `n`'s statement. The oracle test covers the v2 games only; the 152 pattern games and the standalone Two Sum game predate it.

Last full run:
- Logic: 2,889 games at 40 random inputs each with 0 failures. 2,875 also matched their statement's examples; 13 have example text the parser can't read, and 1 has no examples.
- PHP syntax: all `meta.php` files pass `php -l`.
- Pages: all 3,041 `*-game` pages return 200 with the problem panel and no PHP errors.
- Links: guide and session links resolve for every game.
- Browser: screenshots of a sample rendered correctly.

## Worth knowing

- On tiny inputs, a few segment-tree, Fenwick-tree and trie games compute the answer directly. Their step questions still teach the data structure.
- Games accept any valid answer where the problem allows more than one (`cmp`).
- The game iframe in `games/play.php` is held at 28rem by `.game-frame` / `.game-frame-wrap` in `assets/css/app.css`, with no auto-resize, so taller games scroll inside the frame.
- Problem 1730 (Shortest Path to Get Food) used to list 5 as Example 4's output; the correct answer is 6. It is fixed in the local premium statement and in the `context/doocs-leetcode` clone that `build_premium.py` reads, and the game now checks all four examples. Both locations are gitignored, so rebuilding from a fresh doocs clone brings the 5 back until upstream is fixed.
