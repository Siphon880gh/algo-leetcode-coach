## Any repeat is the answer

With a set: for each `x`, if `x` is in the set return it; otherwise add it.

With O(1) space: the repeated value fills half the array, so two copies must sit within distance 3 of each other somewhere. For each `i` and `k` in 1 to 3, if `i + k < 2n` and `nums[i] == nums[i + k]`, return `nums[i]`.

Do not count every value with a map if you only need one repeat. Do not sort just to find neighbors; that is O(n log n).

Time: O(n)  
Space: O(n) with a set, O(1) with the distance check

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
