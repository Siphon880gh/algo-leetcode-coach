## Per-bit counts

1. cnt[b] = how many numbers have bit b.
2. Repeat k times: v = OR of every bit with cnt[b] > 0, decrementing those counts; add v² mod 10^9 + 7.

Examples → 261, 90. Checked against a search over all reachable arrays on 200 random small inputs.

Without operations the best is far smaller: example 1 → 8² + 6² = 100. Each v is below 2^30, so reduce each square mod 10^9 + 7 before adding.

Time: O(31·(n + k))  
Space: O(31)

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
