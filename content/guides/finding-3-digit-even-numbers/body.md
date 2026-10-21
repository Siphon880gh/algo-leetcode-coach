## Enumerate the answers, not the picks

1. `cnt` = counts of `digits`.
2. For `x = 100, 102, …, 998`: keep `x` if each of its digits occurs in `x` no more often than in `cnt`.

Examples → `[102,120,130,132,210,230,302,310,312,320]`, `[222,228,282,288,822,828,882]`, `[]`.

Choosing triples of indices (up to 100³) creates duplicates that need removing; walking the 450 candidates avoids that, and no leading zero can appear.

Time: O(450 · 3 + n)  
Space: O(10)

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
