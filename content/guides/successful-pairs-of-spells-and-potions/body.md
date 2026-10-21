## Threshold per spell

1. Sort `potions`.
2. For spell `s`: `need = ⌈success / s⌉ = (success + s − 1) / s`; answer `m − lower_bound(potions, need)`.

Examples → [4,0,3], [2,0,2].

success reaches 10^10, so use 64-bit, and the integer ceiling avoids floating-point error. Sorting the spells too and moving one pointer is the two-pointer alternative.

Time: O((n + m) log m)  
Space: O(1) beyond sorting and the output

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
