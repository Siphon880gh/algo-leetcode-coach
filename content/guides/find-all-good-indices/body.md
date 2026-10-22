## Two passes, one check

1. `down[i] = down[i − 1] + 1` if `nums[i] ≤ nums[i − 1]`, else 1.
2. `up[i] = up[i + 1] + 1` if `nums[i] ≤ nums[i + 1]`, else 1.
3. Return every `i` in `k … n − k − 1` with `down[i − 1] ≥ k` and `up[i + 1] ≥ k`.

Examples → [2,3], []. Checked against testing both windows directly on 300 random cases.

The value at i itself is not part of either window, so the runs stop at i − 1 and start at i + 1. Equal neighbours keep both runs going, since the orders are non-strict.

Time: O(n)  
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
