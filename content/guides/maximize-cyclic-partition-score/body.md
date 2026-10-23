## Two rotations, pair DP

1. m = index of the maximum. Try a = nums rotated to start at m, and a = nums rotated to end at m.
2. Linear DP with j finished segments: f[j][0] (no open pair), f[j][1] (took +x), f[j][2] (took −x). For each x: open with ±x from f[j][0], or close into f[j + 1][0] with −x from f[j][1] or +x from f[j][2].
3. Return the best f[j][0] over j ≤ k and both rotations.

Examples → 3, 2, 3. Checked against trying every cyclic partition on 1,500 random arrays.

Treating the array as linear: example 1 → 2 instead of 3.

Time: O(n · k)  
Space: O(k)

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
