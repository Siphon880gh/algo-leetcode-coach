## What can be on top

1. `k = 0`: return `nums[0]`.
2. `n = 1`: return `−1` if `k` is odd, else `nums[0]`.
3. Otherwise: `max(max(nums[0 … k − 2]), nums[k] if k < n)`, ignoring missing parts.

Examples → 5, −1. Checked against a full search of move sequences on 400 small piles.

Putting back takes the last move, so only `k − 1` removals can feed it; `nums[k − 1]` itself can never end on top. With two or more elements, extra moves can always be wasted in pairs.

Time: O(min(n, k))  
Space: O(1)

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
