## Size first

1. If `m · n != len(original)`, return `[]`.
2. Return `[original[i·n : (i+1)·n] for i in 0 … m − 1]`.

Examples → `[[1,2],[3,4]]`, `[[1,2,3]]`, `[]`.

Every element must be used, so both too few and too many elements fail. Index `k` lands at row `k / n`, column `k % n`.

Time: O(mn)  
Space: O(mn) for the output

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
