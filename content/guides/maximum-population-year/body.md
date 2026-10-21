## Sweep the century

1. `d[birth − 1950] += 1`, `d[death − 1950] −= 1`.
2. Running sum over years; update the best year only on a strictly larger population.

`[[1993,1999],[2000,2010]]` → 1993. `[[1950,1961],[1960,1971],[1970,1981]]` → 1960.

The −1 at the death year matches the rule that a person is not counted in the year they die. Strict `>` keeps the earliest year.

Time: O(n + 101)  
Space: O(101)

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
