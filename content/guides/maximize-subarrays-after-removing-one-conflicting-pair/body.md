## Sweep the right end

1. Normalize every pair to a < b; list a’s by b.
2. For r = 1 … n: update the top two a values (max1 ≥ max2, 0 if missing) with the pairs whose b = r.
3. base += r − max1; gain[max1] += max1 − max2.
4. Answer base + the largest gain.

Examples → 9, 12. Checked against removing each pair and counting directly on 400 random cases.

Not normalizing the pairs: n = 3, pairs [[2, 1], [3, 2]] → 0 instead of 4.

Time: O(n + pairs)  
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
