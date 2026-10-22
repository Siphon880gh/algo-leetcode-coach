## Run length

1. a = colors + colors[0 … k − 2]. run = 1.
2. For i ≥ 1: run = run + 1 if a[i] ≠ a[i − 1], else 1; count when run ≥ k.

Examples → 3, 2, 0. Checked against testing every start on 300 random circles.

Ignoring the wrap: example 2 → 0 instead of 2. Testing each start directly is O(n k), 10^10 at n = k = 10^5.

Time: O(n + k)  
Space: O(n + k)

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
