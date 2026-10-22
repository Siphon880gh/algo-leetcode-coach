## Count array

1. `cnt[v]` = how many times v is in the window; add `nums[i]`, remove `nums[i − k]` once `i ≥ k`.
2. When `i ≥ k − 1`: walk v = −50 … −1 adding `cnt[v]`; the first v where the total reaches x is the beauty, else 0.

Examples → [−1,−2,−2], [−1,−2,−3,−4], [−3,0,−3,−3,−3]. Checked against sorting every window on 500 random arrays.

Only 50 negative values exist, so the walk is constant work; sorting each window would cost O(k log k) per window.

Time: O(50 · n)  
Space: O(101)

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
