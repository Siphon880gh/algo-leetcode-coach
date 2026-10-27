A sentence of words separated by single spaces must be split into rows of at most k characters each, keeping word order and never splitting a word. A row of length len costs (k − len)², except that the last row costs nothing. Return the minimum total cost. For instance, "i love leetcode" with k = 12 → 36; "apples and bananas taste great" with k = 7 → 21; "a" with k = 5 → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Choose where each row ends

1. `w` = word lengths.
2. `f(i)`: `len = −1`; for `j` from `i`: `len += w[j] + 1`; stop when `len > k`; candidate `0` if `j` is the last word, else `(k − len)² + f(j + 1)`.
3. Return `f(0)`.

Constructed checks (verified against every way of cutting rows on random sentences): the three cases above → 36, 21, 0.

Greedy filling (as many words per row as possible) is not optimal because the squares punish one very short row. Each row holds at most about k / 2 words, so the inner loop is short.

Time: O(n · k)  
Space: O(n)

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
