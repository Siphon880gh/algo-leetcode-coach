## Smallest evens first

1. If `finalSum` is odd, return `[]`.
2. `x = 2`; while `finalSum ≥ x`: take `x`, `finalSum −= x`, `x += 2`.
3. Add the remainder to the last number taken.

Examples → `[2,4,6]`, `[]`, `[2,4,6,16]` (any valid order and split of the same size). Checked against a full search for every finalSum up to 59.

The smallest k distinct evens sum to k(k + 1), so no split can have more numbers. The remainder is less than the next even, so adding it to the largest keeps everything distinct.

Time: O(√finalSum)  
Space: O(√finalSum)

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
