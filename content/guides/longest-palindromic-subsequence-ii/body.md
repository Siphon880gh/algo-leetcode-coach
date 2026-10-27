A good palindromic subsequence has even length and no two consecutive equal characters except the middle two. Return the length of the longest good palindromic subsequence of s. For instance, "bbabab" → 4 ("baab"). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Remember the outer letter

1. `f(i, j, prev)` = longest good palindrome in `s[i..j]` whose outer letter ≠ `prev`.
2. If `s[i] == s[j]` and `s[i] ≠ prev`: `2 + f(i + 1, j − 1, s[i])`.
3. Otherwise `max(f(i + 1, j, prev), f(i, j − 1, prev))`; base `i ≥ j` → 0.

Constructed check: `"bbabab"` → 4. `"dcbccacdb"` → 4. `"aa"` → 2. `"ab"` → 0. (A brute force over all subsequences agrees.)

Using 27 states for `prev` (26 letters plus none) gives O(26 · n²) states; memoise or fill bottom-up. Do not forget the even-length requirement: a single middle letter never counts.

Time: O(26 · n²)  
Space: O(26 · n²)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
