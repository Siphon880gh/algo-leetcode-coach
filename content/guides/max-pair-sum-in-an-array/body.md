## Best per digit

1. `best[d]` = largest number seen with largest digit d.
2. For each v with `d = max digit of v`: if best[d] exists, update the answer with `best[d] + v`; then `best[d] = max(best[d], v)`.
3. Return the answer, or −1.

Examples → −1, 5902, 88.

Start the answer at −1, not 0: example 1 has no pair and must return −1.

Time: O(n log V)  
Space: O(1) (10 digits)

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
