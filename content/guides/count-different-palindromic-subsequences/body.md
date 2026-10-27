## Two cases on the ends

The alphabet is `a … d`. Let `dp[i][j]` be the count for `s[i..j]` (mod 10⁹ + 7), with `dp[i][i] = 1`.

**`s[i] ≠ s[j]`:** `dp[i][j] = dp[i + 1][j] + dp[i][j − 1] − dp[i + 1][j − 1]`.

**`s[i] == s[j] = c`:** every inner palindrome can be wrapped in `c … c`, so start from `2 · dp[i + 1][j − 1]`. Then let `l` be the first and `r` the last index of `c` strictly inside `(i, j)`:

- No `c` inside (`l > r`): add 2, for `"c"` and `"cc"`.
- Exactly one `c` inside (`l == r`): add 1 for `"cc"`; `"c"` was already counted.
- Two or more (`l < r`): subtract `dp[l + 1][r − 1]`; those wrapped in `c … c` were counted twice.

Precompute next and previous occurrences of each letter to find `l` and `r` in O(1).

Take care with the modulus: after subtracting, add the mod back before reducing.

Do not count subsequences by position; the problem wants **distinct** strings. Do not use the plain "count palindromic subsequences" recurrence; it counts duplicates.

Time: O(n²)  
Space: O(n²)

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
