## Next permutation on digits

Write `n` as a digit list `d`.

1. From the right, find the first `i` with `d[i] < d[i + 1]`. If none, the digits are in descending order: return −1.
2. From the right, find the first `j` with `d[j] > d[i]`, and swap `d[i]` and `d[j]`.
3. Reverse `d[i + 1:]` (it was descending; now it is the smallest arrangement).

Convert back and return it if it is at most `2^31 − 1`, else −1. `230241`: `i` is at digit 2 (`2 < 4`), swap with the rightmost larger digit `4`, giving `230421`, then reverse the tail `21` → `230412`.

Next Permutation (31) is the same algorithm on an array.

Do not sort all the digits — that gives the smallest arrangement, not the next one. Do not forget the 32-bit check: `2147483486` has a next permutation that is too large.

Time: O(number of digits)  
Space: O(number of digits)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
