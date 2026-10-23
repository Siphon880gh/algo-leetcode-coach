## Subtree counts

1. Root at 0; count nodes per group in each subtree (bottom-up).
2. For each child v: add Σ over groups g of sub[v][g] · (tot[g] − sub[v][g]).
3. Return the sum.

Examples → 4, 2, 3, 0. Checked against BFS from every node on 1,000 random trees.

Counting every pair, groups ignored: example 2 → 4 instead of 2.

Time: O(20 · n)  
Space: O(20 · n)

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
