## Close runs at boundaries

`start = 0`. For `i` from 1 to `n` (treating `i == n` as a boundary):

- If `i == n` or `s[i] ≠ s[start]`: if `i − start ≥ 3`, record `[start, i − 1]`. Set `start = i`.

The intervals come out in increasing order of start, as required.

Do not forget the final run; checking at `i == n` handles it. Do not record runs of length 2.

Time: O(n)  
Space: O(1) beyond the output

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
