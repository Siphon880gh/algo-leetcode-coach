## Print the first character as far as it helps

`f[i][j]` = fewest turns for `s[i..j]`, with `f[i][i] = 1`. Fill by increasing length:

- If `s[i] == s[j]`: `f[i][j] = f[i][j − 1]`. The turn that prints `s[i]` can extend to cover `j` and later turns paint over the middle.
- Otherwise: `f[i][j] = min over k in [i, j) of f[i][k] + f[k + 1][j]`.

The answer is `f[0][n − 1]`. Removing consecutive duplicates first (`"aaabbb"` → `"ab"`) shrinks `n` without changing the answer.

Do not count the number of distinct characters or color changes; `"aba"` needs 2 turns (print `aaa`, then `b`), not 3. Do not fill the table by `i` ascending; `f[i][j]` needs `f[k + 1][j]` for larger starts, so go by length (or `i` from right to left).

Time: O(n³)  
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
