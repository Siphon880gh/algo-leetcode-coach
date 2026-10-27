## Look at both ends

`f[i][j]` = the answer for `s[i..j]`. Base: `f[i][i] = 1`.

- `s[i] == s[j]`: both ends can wrap the best inside: `f[i][j] = f[i + 1][j − 1] + 2` (for `j = i + 1` the inside is empty, 0).
- Otherwise one end is unused: `f[i][j] = max(f[i + 1][j], f[i][j − 1])`.

Iterate `i` from `n − 1` down to 0 and `j` from `i + 1` up, so the shorter intervals are ready. Answer `f[0][n − 1]`. A 1D rolling array cuts space to O(n).

It also equals the LCS (1143) of `s` and `reverse(s)`. Longest Palindromic Substring (5) needs contiguous characters — a different problem.

Do not use expand-around-center — that finds substrings only. Do not fill `i` upward; `f[i + 1][…]` would not be ready.

Time: O(n²)  
Space: O(n²), or O(n)

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
