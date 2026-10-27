Given stick lengths, joining two sticks of lengths x and y costs x + y and produces one stick of that length. Return the minimum total cost to join all sticks into one. For instance, `[2,4,3]` costs 5 + 9 = 14 and `[1,8,3,5]` costs 4 + 9 + 17 = 30. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Huffman-style merging

1. Heapify the lengths. `cost = 0`.
2. While more than one stick: `a = pop`, `b = pop`, `cost += a + b`, push `a + b`.
3. Return `cost` (0 for a single stick).

Each length is paid once per merge it takes part in, so the longest sticks should be merged last.

Do not sort once and merge left to right; new sticks must re-enter the order. Do not merge the longest first.

Time: O(n log n)  
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
