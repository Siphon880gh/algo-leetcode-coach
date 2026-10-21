## Sum of absolute values, maybe minus one

1. `s = Σ |x|`, `neg` = number of negatives, `mn = min |x|`.
2. Return `s` if `neg` is even, else `s − 2 · mn`.

`[[1,-1],[-1,1]]` → 4. `[[1,2,3],[-1,-2,-3],[1,2,3]]` → 16.

A zero anywhere makes the parity irrelevant: `mn = 0`, so the formula already handles it. The grid is connected, so a sign can travel along any path.

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
