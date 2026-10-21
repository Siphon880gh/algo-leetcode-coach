## Middle element counts

1. For each `j`: count `lessL`, `greaterL` among `i < j`, and `lessR`, `greaterR` among `k > j`.
2. Add `lessL · greaterR + greaterL · lessR`.

`[2,5,3,4,1]` → 3. `[2,1,3]` → 0. `[1,2,3,4]` → 4.

Do not try all triples; that is O(n³). Ratings are distinct, so "less" and "greater" split the others cleanly. A Fenwick tree brings this to O(n log n).

Time: O(n²)  
Space: O(1)

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
