## Check S

1. If the must edges form a cycle, or the whole graph is disconnected, return −1.
2. feasible(S): fail if a must edge has s < S; union the must edges; union optional edges with s ≥ S; then optional edges with s < S ≤ 2s, counting each one that joins two components.
3. S is feasible when one component remains and the count ≤ k. Binary search the largest S.

Free edges go first because they never cost an upgrade, so the upgrade count is the smallest possible.

Examples → 2, 6, −1. Checked against every spanning tree with its best upgrades on 400 random graphs.

Skipping the cycle check on must edges: example 3 → 1 instead of −1.

Time: O((n + E) · α(n) · log max s)  
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
