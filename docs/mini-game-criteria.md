# Mini-game criteria

> **Directive for AI agents and contributors:** when deciding which Algo Guides get a mini game, follow the **[Loosened criteria](#loosened-criteria-use-these)**. The **[Strict criteria](#strict-criteria-original-reference-only)** further down are the original rules from the first 152 games. They are kept for reference and history only. Do not use them to reject a guide. Every guide's loosened score is in **[mini-game-scores.md](mini-game-scores.md)**.

Which Algo Guides get a mini game, and why. Games live under `content/games/{slug}/` (see `.agents/skills/harness`, section 2).

A good mini game is not a quiz about the answer. The player performs the algorithm itself, one decision at a time, and the board reacts.

## Loosened criteria (use these)

The strict rules produced games for only 152 of about 3,460 guides. The loosened rules keep what makes a game worth playing: real per-step decisions, each one checked by an oracle and explained when wrong. They drop the limits that excluded most guides for reasons a small board can fix.

### What changed from the strict rules

1. **Scale the input down instead of rejecting the problem.** A large-state problem qualifies if a tiny instance still shows the decision: 4 balloons for Burst Balloons, a 4×5 DP table for Regular Expression Matching, a graph of 5 to 7 nodes, a segment tree over 8 leaves, a trie of 4 or 5 words.
2. **Longer rounds.** A round may take up to about 5 minutes (strict: 3).
3. **Lower bar.** Qualify at **8/12** (strict: 10/12).
4. **Close variants get their own game** when they have a distinct decision rule or twist, for example House Robber II (the circle split), Best Time to Buy and Sell Stock III/IV (the k-transaction state), or 4Sum (one more fixed index). A variant that is only a re-skin of a gamed sibling with no new decision can still share that rule, but it gets its own page and copy because each guide links to its own game.
5. **No family-level dismissals.** Each guide is scored on its own problem. Families excluded wholesale by the strict rules become playable whenever a real per-step decision can be checked:

| Family (strict: excluded) | Loosened: the per-step decision the game asks for |
|---|---|
| Hash-map lookups, counting | Which key or bucket to update next, and what the count becomes; "seen before?" with the right consequence |
| Simulation, matrix walks | Predict the next state: next cell, next direction, the value after this tick |
| Parsing, string building | The next token or action (push digit, apply sign, flush word, carry) and the running value |
| Math, number theory, bit manipulation | The next loop step: the next digit, remainder, bit, or carry; which branch the loop takes |
| Design (class APIs) | For each call in an operation sequence: which structure to touch and what the call returns |
| Geometry | Which point, side, or comparison the sweep or scan handles next |
| Large DP, segment and Fenwick trees, advanced graphs | The same decisions on a scaled-down instance (rule 1) |
| Interactive, game theory | The next query or move and why it is optimal |

### Gates (loosened, all must pass)

1. **A playable decision.** At least one real step of the solution where the player chooses an action, types a value, or clicks a cell or node, and an oracle can compute the correct answer.
2. **Fits on one screen after scaling down.** See rule 1 above.
3. **Instant, checkable feedback.** Each wrong move gets a one-line "why not".
4. **Not out of scope.** Excluded only when nothing is playable:
   - SQL, Pandas, JavaScript-API, and Shell problems (the skill is query or API syntax, not an algorithmic decision)
   - Concurrency problems (the skill is thread timing, which a turn-based board cannot show)
   - Pure one-line formulas whose answer comes from no sequence of steps, such as Nim Game (`n % 4 != 0`) or Bulb Switcher (`⌊√n⌋`)

### Score (0–2 each, qualify at 8/12 or more)

| Code | Criterion | 2 means | 1 means |
|------|-----------|---------|---------|
| I | Insight in the move | The correct move *is* the key idea | Moves are real steps, but the key idea is in the setup (sort first, pick the right structure) |
| F | Feedback clarity | A wrong move has a crisp one-line "why not" | The "why not" needs a short calculation |
| V | Variety | Fresh random inputs make replays meaningful | Inputs vary but rounds feel alike (a single integer `n`, a fixed board) |
| L | Length | One round is 1–5 minutes at the scaled-down size | Needs the scaled-down size to stay under 5 minutes |
| T | Transfer | The rule recurs across many LeetCode problems | The rule recurs in a few related problems |
| M | Misconception | A common wrong move exists for the game to catch | Mistakes are mostly slips |

### How the scores in mini-game-scores.md were made

- Every guide in `content/guides/` was scored by itself against the loosened rubric, using its own problem: its statement and input shape (array, string, grid, tree, graph, operation list, a single number), its LeetCode topics, difficulty, and a check for one-line formulas.
- A guide that qualifies gets `content/games/{guide-slug}-game/`, except where it already had a game from the first pass. Those keep their game.
- Guides that do not qualify have a one-line reason.

## How the games are built (all games)

- One shared engine (`content/games/_engine/`) gives every game the same board, score, lives, rounds, and "why" feedback. The engine folder has no `meta.php`, so it does not show up as a game.
- One game per qualifying guide: `content/games/{guide-slug}-game/` with `meta.php` and `index.html`. Guides of the same pattern share a pattern module (`_engine/patterns/{pattern}.js`), but each game runs its own problem's rule, inputs, and insight copy.
- Linking: each game's `meta.php` sets `leetcode`, `related_guide`, and `related_session`. The guide and its Step-by-step find the game through the existing companion fallback (same `leetcode` id), so no guide or session `meta.php` had to change. The guide's Mini game prompt builder then shows "already created".

## Strict criteria (original, reference only)

These were the rules for the first 152 games. **They no longer decide which guides get games.** Use the loosened criteria above.

### Gates (all must pass)

1. **Small visual state.** The whole state fits on one screen: an array of about 12 or fewer cells, a grid of about 8×8, a tree of about 15 nodes, a graph of about 10 nodes, a DP table of about 8×8.
2. **Discrete moves that are the algorithm's steps.** Move a pointer, expand or shrink a window, push or pop, pick `lo`/`hi`, fill a DP cell, visit a node. One click equals one step of the real solution.
3. **Instant, checkable feedback.** Every move has one correct choice (or a small set) that a deterministic oracle can check, so a wrong move is caught and explained right away.
4. **The insight is a decision rule.** The aha is *which* move to make and why, for example "move the shorter wall". Problems whose insight is a closed-form formula, a math identity, bit tricks, parsing, or language syntax fail this gate.
5. **Not out of scope.** No SQL, Pandas, JavaScript API, concurrency, or class-design (`Design`) problems. Not already covered by an existing game (Two Sum has `two-sum-pointers`).

### Score (0–2 each, qualify at 10/12 or more)

| Code | Criterion | 2 means |
|------|-----------|---------|
| I | Insight in the move | The correct move *is* the key idea |
| F | Feedback clarity | A wrong move has a crisp one-line "why not" |
| V | Variety | Fresh random inputs make replays meaningful |
| L | Length | One round is 1–3 minutes |
| T | Transfer | The rule recurs across many LeetCode problems |
| M | Misconception | A common wrong move exists for the game to catch |

### What did not qualify under the strict rules (by family)

- **Hash-map lookups** (Contains Duplicate, Group Anagrams, Valid Anagram, Ransom Note, …). The only move is "look it up", so there is no decision to play.
- **Pure math, bit manipulation, geometry** (Single Number, Number of 1 Bits, Pow(x, n), …). The insight is an identity, not a sequence of choices.
- **Simulation and matrix walks** (Spiral Matrix, Rotate Image, Game of Life, Valid Sudoku). The steps are fixed, so the player has nothing to decide.
- **Parsing and string building** (Roman to Integer, String to Integer, Text Justification). These test edge cases and syntax.
- **SQL, Pandas, JavaScript, Concurrency, Design.** Out of scope for a board game.
- **Large or advanced DP, graphs, and segment or Fenwick trees** (Burst Balloons, Regular Expression Matching, Range Sum Query – Mutable, …). The state is too large for one screen, or a round would run far past 3 minutes.
- **Variants whose decision rule matches a qualifying sibling but whose state is bigger** (for example k-Sum beyond 3Sum, Best Time to Buy and Sell Stock III/IV). These fail on V and L, scoring 9 or less.

### Guides that qualified under the strict rules (152) and their games

Score order: I/F/V/L/T/M.


#### Two Pointers

| LC | Algo Guide | Game | Score | Insight the game drills |
|----|-----------|------|-------|--------------------------|
| 11 | `container-with-most-water` | `container-with-most-water-game` | 2/2/2/2/2/2 = 12 | Always move the shorter wall; moving the taller one can never raise the area. |
| 15 | `3sum` | `3sum-game` | 2/2/2/1/2/2 = 11 | Fix i, squeeze l/r; skip duplicate values so triplets stay unique. |
| 16 | `3sum-closest` | `3sum-closest-game` | 2/2/1/1/2/2 = 10 | Squeeze like 3Sum but track the closest sum; equal means stop early. |
| 26 | `remove-duplicates-from-sorted-array` | `remove-duplicates-from-sorted-array-game` | 2/2/2/2/2/2 = 12 | Write pointer only advances when the read value differs from the last kept value. |
| 27 | `remove-element` | `remove-element-game` | 2/2/2/1/2/2 = 11 | Copy every value that is not val to the write pointer; skip the rest. |
| 42 | `trapping-rain-water` | `trapping-rain-water-game` | 2/2/2/1/2/2 = 11 | Move the side with the smaller max; its water level is already decided. |
| 75 | `sort-colors` | `sort-colors-game` | 2/2/2/2/2/2 = 12 | Dutch flag: 0 → swap to low, 2 → swap to high (do not advance mid), 1 → step. |
| 125 | `valid-palindrome` | `valid-palindrome-game` | 2/2/1/2/2/2 = 11 | Skip non-alphanumerics on each side, then compare lowercase; any mismatch fails. |
| 167 | `two-sum-ii-input-array-is-sorted` | `two-sum-ii-input-array-is-sorted-game` | 2/2/2/2/2/2 = 12 | Sum too big → move right in; too small → move left in (sorted order makes one side useless). |
| 283 | `move-zeroes` | `move-zeroes-game` | 2/2/2/1/2/2 = 11 | Write non-zeros forward in order, zeros naturally pile up behind. |
| 680 | `valid-palindrome-ii` | `valid-palindrome-ii-game` | 2/2/2/1/2/2 = 11 | On the first mismatch you may delete exactly one side; try both, no second chance. |
| 881 | `boats-to-save-people` | `boats-to-save-people-game` | 2/2/2/2/2/2 = 12 | Heaviest always boards; pair the lightest with it only if they fit together. |
| 977 | `squares-of-a-sorted-array` | `squares-of-a-sorted-array-game` | 2/2/2/1/2/2 = 11 | Largest square sits at one of the two ends; fill the output from the back. |
| 1679 | `max-number-of-k-sum-pairs` | `max-number-of-k-sum-pairs-game` | 2/2/2/1/2/2 = 11 | Sort, then pair ends: sum == k counts and moves both, otherwise move like Two Sum II. |

#### Sliding Window

| LC | Algo Guide | Game | Score | Insight the game drills |
|----|-----------|------|-------|--------------------------|
| 3 | `longest-substring-without-repeating-characters` | `longest-substring-without-repeating-characters-game` | 2/2/2/2/2/2 = 12 | Expand right; while the new char is a repeat, shrink from the left. |
| 76 | `minimum-window-substring` | `minimum-window-substring-game` | 2/2/1/1/2/2 = 10 | Expand until every needed char is covered, then shrink to the tightest cover. |
| 209 | `minimum-size-subarray-sum` | `minimum-size-subarray-sum-game` | 2/2/2/2/2/2 = 12 | Expand until sum ≥ target, then shrink as far as possible while it still holds. |
| 424 | `longest-repeating-character-replacement` | `longest-repeating-character-replacement-game` | 2/2/1/1/2/2 = 10 | Valid while windowLen − maxFreq ≤ k; shrink when replacements needed exceed k. |
| 438 | `find-all-anagrams-in-a-string` | `find-all-anagrams-in-a-string-game` | 2/2/2/1/2/2 = 11 | Fixed window of len(p): every position whose counts match is an anagram start. |
| 567 | `permutation-in-string` | `permutation-in-string-game` | 2/2/2/1/2/2 = 11 | Fixed-size window of len(s1): slide and compare letter counts. |
| 643 | `maximum-average-subarray-i` | `maximum-average-subarray-i-game` | 2/2/2/1/2/2 = 11 | Fixed window of k: add the new value, drop the leaving value; never re-sum. |
| 904 | `fruit-into-baskets` | `fruit-into-baskets-game` | 2/2/2/1/2/2 = 11 | At most 2 distinct fruit types; shrink when a third type enters. |
| 1004 | `max-consecutive-ones-iii` | `max-consecutive-ones-iii-game` | 2/2/2/2/2/2 = 12 | Window may hold at most k zeros; shrink only when the zero count exceeds k. |
| 1456 | `maximum-number-of-vowels-in-a-substring-of-given-length` | `maximum-number-of-vowels-in-a-substring-of-given-length-game` | 2/2/2/1/2/2 = 11 | Fixed window: +1 if entering is a vowel, −1 if leaving is a vowel. |
| 1493 | `longest-subarray-of-1s-after-deleting-one-element` | `longest-subarray-of-1s-after-deleting-one-element-game` | 2/2/2/1/2/2 = 11 | At most one zero in the window; answer is window length − 1. |
| 1695 | `maximum-erasure-value` | `maximum-erasure-value-game` | 2/2/2/1/2/2 = 11 | Unique-elements window maximizing sum; shrink past the earlier duplicate. |
| 2024 | `maximize-the-confusion-of-an-exam` | `maximize-the-confusion-of-an-exam-game` | 2/2/1/1/2/2 = 10 | Run the ≤k-flips window twice: once against T, once against F. |

#### Stack

| LC | Algo Guide | Game | Score | Insight the game drills |
|----|-----------|------|-------|--------------------------|
| 20 | `valid-parentheses` | `valid-parentheses-game` | 2/2/2/2/2/2 = 12 | Push openers; a closer must match the top or the string is invalid. |
| 32 | `longest-valid-parentheses` | `longest-valid-parentheses-game` | 2/2/1/1/2/2 = 10 | Keep a base index on the stack; a ')' that empties it becomes the new base. |
| 71 | `simplify-path` | `simplify-path-game` | 2/2/2/1/2/2 = 11 | '..' pops a directory, '.' and empty do nothing, names push. |
| 150 | `evaluate-reverse-polish-notation` | `evaluate-reverse-polish-notation-game` | 2/2/2/2/2/2 = 12 | Numbers push; an operator pops two (second popped is the left operand). |
| 682 | `baseball-game` | `baseball-game-game` | 2/2/2/1/2/2 = 11 | Integer pushes, '+' sums the top two, 'D' doubles top, 'C' pops. |
| 735 | `asteroid-collision` | `asteroid-collision-game` | 2/2/2/1/2/2 = 11 | Only a left-moving asteroid hitting a right-moving top collides; bigger survives. |
| 844 | `backspace-string-compare` | `backspace-string-compare-game` | 2/2/2/1/2/2 = 11 | '#' pops the last typed char (if any); compare the final stacks. |
| 921 | `minimum-add-to-make-parentheses-valid` | `minimum-add-to-make-parentheses-valid-game` | 2/2/2/1/2/2 = 11 | Unmatched ')' needs an insert now; leftover '(' at the end each need one. |
| 1047 | `remove-all-adjacent-duplicates-in-string` | `remove-all-adjacent-duplicates-in-string-game` | 2/2/2/1/2/2 = 11 | Push a char unless it equals the top; then pop both away. |
| 1249 | `minimum-remove-to-make-valid-parentheses` | `minimum-remove-to-make-valid-parentheses-game` | 2/2/2/1/2/2 = 11 | Stack the indexes of '('; unmatched ')' and leftover '(' get removed. |
| 1544 | `make-the-string-great` | `make-the-string-great-game` | 2/2/2/1/2/2 = 11 | Pop when the top is the same letter in the opposite case. |

#### Monotonic Stack

| LC | Algo Guide | Game | Score | Insight the game drills |
|----|-----------|------|-------|--------------------------|
| 84 | `largest-rectangle-in-histogram` | `largest-rectangle-in-histogram-game` | 2/2/1/1/2/2 = 10 | Increasing stack; a shorter bar pops and settles the width of each taller bar. |
| 402 | `remove-k-digits` | `remove-k-digits-game` | 2/2/2/1/2/2 = 11 | While k > 0 and the top digit is bigger than the incoming one, pop it. |
| 496 | `next-greater-element-i` | `next-greater-element-i-game` | 2/2/2/1/2/2 = 11 | Monotonic stack over nums2 builds a next-greater map, then look up nums1. |
| 503 | `next-greater-element-ii` | `next-greater-element-ii-game` | 2/2/1/1/2/2 = 10 | Circular: run the decreasing stack over the array twice. |
| 739 | `daily-temperatures` | `daily-temperatures-game` | 2/2/2/2/2/2 = 12 | Keep a decreasing stack of indexes; a warmer day pops and answers them. |
| 901 | `online-stock-span` | `online-stock-span-game` | 2/2/2/1/2/2 = 11 | Pop every price ≤ today and absorb its span. |
| 1019 | `next-greater-node-in-linked-list` | `next-greater-node-in-linked-list-game` | 2/2/2/1/2/2 = 11 | Next greater element, but walking a linked list. |
| 1475 | `final-prices-with-a-special-discount-in-a-shop` | `final-prices-with-a-special-discount-in-a-shop-game` | 2/2/2/1/2/2 = 11 | The first later price ≤ current is its discount: pop while the new price ≤ top. |

#### Binary Search

| LC | Algo Guide | Game | Score | Insight the game drills |
|----|-----------|------|-------|--------------------------|
| 33 | `search-in-rotated-sorted-array` | `search-in-rotated-sorted-array-game` | 2/2/1/1/2/2 = 10 | One half is always sorted; check whether the target lies in that half. |
| 34 | `find-first-and-last-position-of-element-in-sorted-array` | `find-first-and-last-position-of-element-in-sorted-array-game` | 2/2/1/1/2/2 = 10 | Two searches: leftmost bound and rightmost bound. |
| 35 | `search-insert-position` | `search-insert-position-game` | 2/2/2/1/2/2 = 11 | Find the first index with nums[i] ≥ target; lo ends at the insert spot. |
| 69 | `sqrt-x` | `sqrt-x-game` | 2/2/2/1/2/2 = 11 | Largest x with x·x ≤ n; binary search on the answer. |
| 74 | `search-a-2d-matrix` | `search-a-2d-matrix-game` | 2/2/2/1/2/2 = 11 | Treat the matrix as one sorted array: index → (i / cols, i % cols). |
| 153 | `find-minimum-in-rotated-sorted-array` | `find-minimum-in-rotated-sorted-array-game` | 2/2/2/2/2/2 = 12 | Compare mid to hi: mid > hi means the drop (minimum) is to the right. |
| 162 | `find-peak-element` | `find-peak-element-game` | 2/2/2/1/2/2 = 11 | Walk uphill: if nums[mid] < nums[mid+1] a peak is on the right. |
| 278 | `first-bad-version` | `first-bad-version-game` | 2/2/2/2/2/2 = 12 | Bad mid → answer is mid or left (hi = mid); good mid → lo = mid + 1. |
| 367 | `valid-perfect-square` | `valid-perfect-square-game` | 2/2/2/1/2/2 = 11 | Search for x with x·x == n exactly. |
| 374 | `guess-number-higher-or-lower` | `guess-number-higher-or-lower-game` | 2/2/2/1/2/2 = 11 | guess() says higher or lower; halve the range every guess. |
| 441 | `arranging-coins` | `arranging-coins-game` | 2/2/2/1/2/2 = 11 | Largest k with k(k+1)/2 ≤ n. |
| 540 | `single-element-in-a-sorted-array` | `single-element-in-a-sorted-array-game` | 2/2/1/1/2/2 = 10 | Pair parity: at even mid, nums[mid] == nums[mid+1] means the single is right. |
| 704 | `binary-search` | `binary-search-game` | 2/2/2/2/2/2 = 12 | Compare nums[mid] to target; discard the half that cannot contain it. |
| 744 | `find-smallest-letter-greater-than-target` | `find-smallest-letter-greater-than-target-game` | 2/2/2/1/2/2 = 11 | First letter strictly greater than target, wrapping to the start. |
| 852 | `peak-index-in-a-mountain-array` | `peak-index-in-a-mountain-array-game` | 2/2/2/1/2/2 = 11 | Same uphill rule on a mountain array. |
| 875 | `koko-eating-bananas` | `koko-eating-bananas-game` | 2/2/2/2/2/2 = 12 | Binary search on speed k: can she finish in h hours? |
| 1011 | `capacity-to-ship-packages-within-d-days` | `capacity-to-ship-packages-within-d-days-game` | 2/2/2/1/2/2 = 11 | Binary search on capacity: can we ship within D days? |

#### Grid Flood Fill / BFS

| LC | Algo Guide | Game | Score | Insight the game drills |
|----|-----------|------|-------|--------------------------|
| 130 | `surrounded-regions` | `surrounded-regions-game` | 2/2/2/1/2/2 = 11 | Mark border-connected O's safe; capture every other O. |
| 200 | `number-of-islands` | `number-of-islands-game` | 2/2/2/2/2/2 = 12 | Each unvisited land cell starts a new island; flood it so it is never counted again. |
| 417 | `pacific-atlantic-water-flow` | `pacific-atlantic-water-flow-game` | 2/2/1/1/2/2 = 10 | Flood uphill from each ocean's edge; cells reached by both drain to both. |
| 542 | `01-matrix` | `01-matrix-game` | 2/2/2/1/2/2 = 11 | BFS from every 0 at once; distance grows by layer. |
| 695 | `max-area-of-island` | `max-area-of-island-game` | 2/2/2/1/2/2 = 11 | Flood each island and count its cells; keep the max. |
| 733 | `flood-fill` | `flood-fill-game` | 2/2/2/1/2/2 = 11 | Flood only 4-connected cells of the starting color. |
| 994 | `rotting-oranges` | `rotting-oranges-game` | 2/2/2/2/2/2 = 12 | Multi-source BFS: every rotten orange spreads together, one minute per layer. |
| 1020 | `number-of-enclaves` | `number-of-enclaves-game` | 2/2/2/1/2/2 = 11 | Flood land from the border first; whatever land remains is enclosed. |
| 1254 | `number-of-closed-islands` | `number-of-closed-islands-game` | 2/2/1/1/2/2 = 10 | Islands touching the border are not closed; count only fully enclosed islands. |
| 1905 | `count-sub-islands` | `count-sub-islands-game` | 2/2/1/1/2/2 = 10 | A grid-2 island is a sub-island only if every cell is land in grid 1. |

#### DP Table

| LC | Algo Guide | Game | Score | Insight the game drills |
|----|-----------|------|-------|--------------------------|
| 62 | `unique-paths` | `unique-paths-game` | 2/2/2/2/2/2 = 12 | paths[r][c] = paths from above + paths from the left. |
| 63 | `unique-paths-ii` | `unique-paths-ii-game` | 2/2/2/1/2/2 = 11 | Same as Unique Paths, but obstacle cells are 0. |
| 64 | `minimum-path-sum` | `minimum-path-sum-game` | 2/2/2/1/2/2 = 11 | cost[r][c] = grid[r][c] + min(cost above, cost left). |
| 70 | `climbing-stairs` | `climbing-stairs-game` | 2/2/2/2/2/2 = 12 | ways(n) = ways(n−1) + ways(n−2): last step was 1 or 2. |
| 72 | `edit-distance` | `edit-distance-game` | 2/2/1/1/2/2 = 10 | Match → diagonal; else 1 + min(insert, delete, replace). |
| 91 | `decode-ways` | `decode-ways-game` | 2/2/2/1/2/2 = 11 | One digit (1–9) adds dp[i−1]; a valid two-digit 10–26 adds dp[i−2]. |
| 120 | `triangle` | `triangle-game` | 2/2/2/1/2/2 = 11 | Bottom-up: each cell = value + min of the two cells below. |
| 139 | `word-break` | `word-break-game` | 2/2/1/1/2/2 = 10 | ok[i] is true if some word ends at i and ok[start of that word] is true. |
| 198 | `house-robber` | `house-robber-game` | 2/2/2/2/2/2 = 12 | At each house: rob it (dp[i−2] + val) or skip it (dp[i−1]). |
| 213 | `house-robber-ii` | `house-robber-ii-game` | 2/2/1/1/2/2 = 10 | Circle: run House Robber without the last house and without the first house. |
| 221 | `maximal-square` | `maximal-square-game` | 2/2/2/1/2/2 = 11 | side = 1 + min(top, left, top-left) when the cell is '1'. |
| 279 | `perfect-squares` | `perfect-squares-game` | 2/2/1/1/2/2 = 10 | dp[n] = 1 + min over squares s ≤ n of dp[n − s]. |
| 300 | `longest-increasing-subsequence` | `longest-increasing-subsequence-game` | 2/2/2/1/2/2 = 11 | dp[i] = 1 + max dp[j] over earlier j with nums[j] < nums[i]. |
| 322 | `coin-change` | `coin-change-game` | 2/2/2/2/2/2 = 12 | dp[a] = 1 + min over coins of dp[a − coin]. |
| 416 | `partition-equal-subset-sum` | `partition-equal-subset-sum-game` | 2/2/1/1/2/2 = 10 | Subset-sum to total/2; iterate sums downward per number. |
| 518 | `coin-change-ii` | `coin-change-ii-game` | 2/2/1/1/2/2 = 10 | Coins in the outer loop so combinations are not counted twice. |
| 746 | `min-cost-climbing-stairs` | `min-cost-climbing-stairs-game` | 2/2/2/1/2/2 = 11 | cost to reach i = min(reach(i−1)+cost[i−1], reach(i−2)+cost[i−2]). |
| 931 | `minimum-falling-path-sum` | `minimum-falling-path-sum-game` | 2/2/2/1/2/2 = 11 | Each cell = value + min of the three cells above it. |
| 1143 | `longest-common-subsequence` | `longest-common-subsequence-game` | 2/2/2/2/2/2 = 12 | Match → diagonal + 1; mismatch → max(top, left). |

#### Running Best (Kadane)

| LC | Algo Guide | Game | Score | Insight the game drills |
|----|-----------|------|-------|--------------------------|
| 53 | `maximum-subarray` | `maximum-subarray-game` | 2/2/2/2/2/2 = 12 | Extend the running sum or restart at the current value, whichever is bigger. |
| 121 | `best-time-to-buy-and-sell-stock` | `best-time-to-buy-and-sell-stock-game` | 2/2/2/2/2/2 = 12 | Track the lowest price so far; today's profit = price − min. |
| 122 | `best-time-to-buy-and-sell-stock-ii` | `best-time-to-buy-and-sell-stock-ii-game` | 2/2/2/1/2/2 = 11 | Take every upward step: sum all positive day-to-day differences. |
| 152 | `maximum-product-subarray` | `maximum-product-subarray-game` | 2/2/1/1/2/2 = 10 | Track both max and min products; a negative number swaps them. |
| 918 | `maximum-sum-circular-subarray` | `maximum-sum-circular-subarray-game` | 2/2/1/1/2/2 = 10 | Answer = max(best normal subarray, total − worst subarray), unless all negative. |

#### Intervals Sweep

| LC | Algo Guide | Game | Score | Insight the game drills |
|----|-----------|------|-------|--------------------------|
| 56 | `merge-intervals` | `merge-intervals-game` | 2/2/2/2/2/2 = 12 | Sort by start; overlap with the last merged → extend, else start a new block. |
| 57 | `insert-interval` | `insert-interval-game` | 2/2/2/1/2/2 = 11 | Copy intervals that end before, merge the overlapping ones, copy the rest. |
| 252 | `meeting-rooms` | `meeting-rooms-game` | 2/2/2/1/2/2 = 11 | Sorted by start: any meeting starting before the previous ends is a clash. |
| 253 | `meeting-rooms-ii` | `meeting-rooms-ii-game` | 2/2/2/2/2/2 = 12 | Sweep starts and ends: reuse a room if the earliest end is ≤ the new start. |
| 435 | `non-overlapping-intervals` | `non-overlapping-intervals-game` | 2/2/2/1/2/2 = 11 | Keep the interval that ends earliest; remove the one that overlaps it. |
| 452 | `minimum-number-of-arrows-to-burst-balloons` | `minimum-number-of-arrows-to-burst-balloons-game` | 2/2/2/1/2/2 = 11 | Shoot at the earliest end; every balloon starting before it pops too. |
| 986 | `interval-list-intersections` | `interval-list-intersections-game` | 2/2/1/1/2/2 = 10 | Intersect the two current intervals, then advance the one that ends first. |

#### Linked List Pointers

| LC | Algo Guide | Game | Score | Insight the game drills |
|----|-----------|------|-------|--------------------------|
| 19 | `remove-nth-node-from-end-of-list` | `remove-nth-node-from-end-of-list-game` | 2/2/2/1/2/2 = 11 | Give fast an n-step head start; when it hits the end, slow is before the target. |
| 21 | `merge-two-sorted-lists` | `merge-two-sorted-lists-game` | 2/2/2/2/2/2 = 12 | Attach the smaller head to the tail and advance that list. |
| 24 | `swap-nodes-in-pairs` | `swap-nodes-in-pairs-game` | 2/2/1/1/2/2 = 10 | Rewire prev → second → first → rest, then jump two. |
| 83 | `remove-duplicates-from-sorted-list` | `remove-duplicates-from-sorted-list-game` | 2/2/2/1/2/2 = 11 | If next has the same value, skip it; otherwise advance. |
| 92 | `reverse-linked-list-ii` | `reverse-linked-list-ii-game` | 2/2/1/1/2/2 = 10 | Walk to left−1, then repeatedly move the next node to the front of the sublist. |
| 141 | `linked-list-cycle` | `linked-list-cycle-game` | 2/2/2/1/2/2 = 11 | Slow moves 1, fast moves 2; if they ever meet there is a cycle. |
| 142 | `linked-list-cycle-ii` | `linked-list-cycle-ii-game` | 2/2/1/1/2/2 = 10 | After slow and fast meet, restart one at the head; they meet at the cycle entry. |
| 203 | `remove-linked-list-elements` | `remove-linked-list-elements-game` | 2/2/2/1/2/2 = 11 | A dummy head lets you delete the first node the same way as the rest. |
| 206 | `reverse-linked-list` | `reverse-linked-list-game` | 2/2/2/2/2/2 = 12 | Save next, point curr back to prev, then advance prev and curr. |
| 328 | `odd-even-linked-list` | `odd-even-linked-list-game` | 2/2/1/1/2/2 = 10 | Weave odd and even chains, then attach evens after odds. |
| 876 | `middle-of-the-linked-list` | `middle-of-the-linked-list-game` | 2/2/2/1/2/2 = 11 | When fast reaches the end, slow is at the middle. |

#### Tree Walk

| LC | Algo Guide | Game | Score | Insight the game drills |
|----|-----------|------|-------|--------------------------|
| 94 | `binary-tree-inorder-traversal` | `binary-tree-inorder-traversal-game` | 2/2/2/2/2/2 = 12 | Inorder: left subtree, node, right subtree. |
| 98 | `validate-binary-search-tree` | `validate-binary-search-tree-game` | 2/2/2/1/2/2 = 11 | Every node must sit inside (low, high) bounds inherited from ancestors. |
| 102 | `binary-tree-level-order-traversal` | `binary-tree-level-order-traversal-game` | 2/2/2/2/2/2 = 12 | BFS with a queue, one level at a time. |
| 103 | `binary-tree-zigzag-level-order-traversal` | `binary-tree-zigzag-level-order-traversal-game` | 2/2/1/1/2/2 = 10 | Level order, but flip direction every level. |
| 107 | `binary-tree-level-order-traversal-ii` | `binary-tree-level-order-traversal-ii-game` | 2/2/1/1/2/2 = 10 | Level order, then read the levels bottom-up. |
| 144 | `binary-tree-preorder-traversal` | `binary-tree-preorder-traversal-game` | 2/2/2/1/2/2 = 11 | Preorder: node, left subtree, right subtree. |
| 145 | `binary-tree-postorder-traversal` | `binary-tree-postorder-traversal-game` | 2/2/2/1/2/2 = 11 | Postorder: left subtree, right subtree, node. |
| 199 | `binary-tree-right-side-view` | `binary-tree-right-side-view-game` | 2/2/2/1/2/2 = 11 | The last node in each BFS level is visible from the right. |
| 230 | `kth-smallest-element-in-a-bst` | `kth-smallest-element-in-a-bst-game` | 2/2/2/1/2/2 = 11 | Inorder of a BST is sorted; the k-th visited node is the answer. |
| 235 | `lowest-common-ancestor-of-a-binary-search-tree` | `lowest-common-ancestor-of-a-binary-search-tree-game` | 2/2/2/1/2/2 = 11 | The first node where p and q split sides (or equals one) is the LCA. |
| 700 | `search-in-a-binary-search-tree` | `search-in-a-binary-search-tree-game` | 2/2/2/1/2/2 = 11 | BST: go left if the target is smaller, right if larger. |
| 701 | `insert-into-a-binary-search-tree` | `insert-into-a-binary-search-tree-game` | 2/2/2/1/2/2 = 11 | Walk the BST like a search; insert at the empty spot you fall into. |

#### Heap Top-K

| LC | Algo Guide | Game | Score | Insight the game drills |
|----|-----------|------|-------|--------------------------|
| 215 | `kth-largest-element-in-an-array` | `kth-largest-element-in-an-array-game` | 2/2/2/1/2/2 = 11 | Keep a min-heap of size k; its top is the k-th largest. |
| 703 | `kth-largest-element-in-a-stream` | `kth-largest-element-in-a-stream-game` | 2/2/2/1/2/2 = 11 | Stream version: push, then pop while size > k; report the top. |
| 973 | `k-closest-points-to-origin` | `k-closest-points-to-origin-game` | 2/2/1/1/2/2 = 10 | Keep the k closest: a max-heap by distance evicts the farthest. |

#### Graph Visit / Topo Sort

| LC | Algo Guide | Game | Score | Insight the game drills |
|----|-----------|------|-------|--------------------------|
| 207 | `course-schedule` | `course-schedule-game` | 2/2/2/2/2/2 = 12 | Kahn's algorithm: take any course with in-degree 0; a leftover means a cycle. |
| 210 | `course-schedule-ii` | `course-schedule-ii-game` | 2/2/2/1/2/2 = 11 | Same as 207, and the removal order is the schedule. |
| 841 | `keys-and-rooms` | `keys-and-rooms-game` | 2/2/2/1/2/2 = 11 | DFS from room 0 with a visited set; every key opens a new room. |
| 1971 | `find-if-path-exists-in-graph` | `find-if-path-exists-in-graph-game` | 2/2/2/1/2/2 = 11 | BFS/DFS from source with a visited set; reach destination or exhaust. |

#### Union-Find

| LC | Algo Guide | Game | Score | Insight the game drills |
|----|-----------|------|-------|--------------------------|
| 323 | `number-of-connected-components-in-an-undirected-graph` | `number-of-connected-components-in-an-undirected-graph-game` | 2/2/2/1/2/2 = 11 | Start with n components; each successful union removes one. |
| 547 | `number-of-provinces` | `number-of-provinces-game` | 2/2/2/1/2/2 = 11 | Union every connected pair; the number of distinct roots is the answer. |
| 684 | `redundant-connection` | `redundant-connection-game` | 2/2/2/2/2/2 = 12 | The first edge whose endpoints already share a root closes a cycle. |

#### Backtracking

| LC | Algo Guide | Game | Score | Insight the game drills |
|----|-----------|------|-------|--------------------------|
| 22 | `generate-parentheses` | `generate-parentheses-game` | 2/2/2/2/2/2 = 12 | Add '(' while open < n; add ')' only while close < open. |
| 39 | `combination-sum` | `combination-sum-game` | 2/2/1/1/2/2 = 10 | Reuse allowed: start from the same index, stop when the sum overshoots. |
| 46 | `permutations` | `permutations-game` | 2/2/2/1/2/2 = 11 | Pick an unused number, recurse, then un-pick it. |
| 51 | `n-queens` | `n-queens-game` | 2/2/2/2/2/2 = 12 | One queen per row; a column or diagonal already attacked forces backtracking. |
| 78 | `subsets` | `subsets-game` | 2/2/2/1/2/2 = 11 | For each element decide: include it or not. |
| 79 | `word-search` | `word-search-game` | 2/2/2/1/2/2 = 11 | DFS from each matching cell; mark visited, unmark on the way back. |

#### Greedy Reach

| LC | Algo Guide | Game | Score | Insight the game drills |
|----|-----------|------|-------|--------------------------|
| 45 | `jump-game-ii` | `jump-game-ii-game` | 2/2/1/1/2/2 = 10 | BFS by ranges: jump when you hit the end of the current reach. |
| 55 | `jump-game` | `jump-game-game` | 2/2/2/2/2/2 = 12 | Track the farthest reachable index; if you stand beyond it you are stuck. |
| 134 | `gas-station` | `gas-station-game` | 2/2/1/1/2/2 = 10 | When the tank goes negative, the start must be after this station. |
| 455 | `assign-cookies` | `assign-cookies-game` | 2/2/2/1/2/2 = 11 | Sort both; give the smallest cookie that satisfies the least greedy child. |
| 605 | `can-place-flowers` | `can-place-flowers-game` | 2/2/2/1/2/2 = 11 | Plant whenever the left and right neighbors are empty. |
| 763 | `partition-labels` | `partition-labels-game` | 2/2/2/1/2/2 = 11 | Extend the partition to the last occurrence of every letter inside it. |

#### Prefix Sum

| LC | Algo Guide | Game | Score | Insight the game drills |
|----|-----------|------|-------|--------------------------|
| 525 | `contiguous-array` | `contiguous-array-game` | 2/2/1/1/2/2 = 10 | +1 for 1, −1 for 0; equal balances mark a balanced subarray. |
| 560 | `subarray-sum-equals-k` | `subarray-sum-equals-k-game` | 2/2/2/1/2/2 = 11 | A subarray sums to k when prefix − k was seen before; count those. |
| 724 | `find-pivot-index` | `find-pivot-index-game` | 2/2/2/1/2/2 = 11 | Pivot where leftSum == total − leftSum − nums[i]. |
