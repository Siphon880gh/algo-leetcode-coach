`nums` has length `n` (1 to 1e5), every value is in `[1, n]`, and each value appears once or twice. Return every value that appears twice, in O(n) time and O(1) extra space (the output does not count). `[4,3,2,7,8,2,3,1]` → `[2,3]`. `[1,1,2]` → `[1]`. `[1]` → `[]`.

## Use the array as its own seen-set

Each value `x` points at slot `x − 1`. Walk the array. For `x = |nums[i]|`, look at `nums[x − 1]`. If it is already negative, `x` was seen before: add `x` to the answer. Otherwise flip it negative to mark `x` as seen. Read `|nums[i]|` because an earlier step may have flipped this slot.

Cycle sort also works: swap `nums[i]` into slot `nums[i] − 1` until it is already home or the target slot holds the same value. Afterwards, every index `i` with `nums[i] != i + 1` holds a duplicate.

Find All Numbers Disappeared in an Array (448) uses the same marking to list missing values. Find the Duplicate Number (287) has exactly one repeated value and forbids modifying the array.

Do not use a hash set (O(n) extra). Do not sort (O(n log n)). Do not index with the signed value after flipping.

Time: O(n)  
Space: O(1) extra

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
