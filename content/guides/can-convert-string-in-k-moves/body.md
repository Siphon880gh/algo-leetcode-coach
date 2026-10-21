## Count repeated shifts

1. Lengths must match.
2. For each `d > 0`: the m-th occurrence needs move `d + 26·(m − 1)`; if that exceeds k, return false.

`"input"` → `"ouput"`, k = 9 → true. `"abc"` → `"bcd"`, k = 10 → false (shift 1 needed three times: moves 1, 27, 53). `"aab"` → `"bbb"`, k = 27 → true.

Do not forget that each move number can be used at most once. Shift 0 needs no move.

Time: O(n)  
Space: O(26)

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
