## Point updates per value

1. If max(nums) ≤ 0, answer max(nums) (removals cannot help).
2. Build the tree; best = root’s best subarray.
3. For each distinct x: set its positions to 0, best = max(best, root), then restore them.

Examples → 7, 10. Checked against removing each value and running Kadane on 600 random arrays.

Skipping the all-negative case: [−3, −1, −2] → 0 instead of −1 (zeros act as an empty subarray).

Time: O(n log n) (each position is updated twice)  
Space: O(n)

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
