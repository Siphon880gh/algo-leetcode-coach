## Inclusion–exclusion with XOR

1. `P[i + 1][j + 1] = P[i][j + 1] ^ P[i + 1][j] ^ P[i][j] ^ matrix[i][j]`.
2. Gather the `m · n` values.
3. Take the kth largest (sort, or quickselect / a size-k min-heap).

`[[5,2],[1,6]]` gives 5, 7, 4, 0 → k = 1, 2, 3 → 7, 5, 4.

The overlap `P[i][j]` is XORed in once more, which cancels the double count just as subtraction does for sums.

Time: O(m · n · log(m · n)) with sorting  
Space: O(m · n)

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
