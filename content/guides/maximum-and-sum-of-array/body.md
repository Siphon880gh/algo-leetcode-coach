## Slot fill levels as base-3 digits

1. `f(i, mask)`: best for `nums[i …]` with slot fill levels `mask` (digit `s` = how many in slot `s + 1`).
2. If `i = n`: 0.
3. Otherwise try each slot with digit `< 2`: `(nums[i] AND (s + 1)) + f(i + 1, mask + 3^s)`.

Examples → 9, 24.

With at most 9 slots there are `3^9 = 19683` masks. The number of placed items equals the digit sum of the mask, so `i` could be dropped from the state.

Time: O(3^k · k)  
Space: O(3^k)

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
