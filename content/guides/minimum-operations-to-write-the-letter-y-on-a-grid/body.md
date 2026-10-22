## Six pairs

1. Cell (r, c) is in the Y if r < n/2 and (c = r or c = n − 1 − r), or r ≥ n/2 and c = n/2 (integer division).
2. cy, cn = value counts inside and outside; ny = Y size.
3. Return min over a ≠ b of (ny − cy[a]) + (n² − ny − cn[b]).

Examples → 3, 12.

The two values must differ: allowing a = b gives example 2 → 11 instead of 12.

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
