## Fight the top

1. For robots in position order: push R robots.
2. For an L robot, while the stack is non-empty and it is alive: the weaker of it and the top dies and the stronger loses 1; equal health removes both.
3. Return healths above 0 in input order.

Examples → [2, 17, 9, 15, 10], [14], []. Checked against a half-step simulation on 300 random small cases.

Only an R robot to the left meets an L robot to the right, so the stack holds exactly the robots that can still collide. Report in input order, not position order: example 1 has positions descending.

Time: O(n log n)  
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
