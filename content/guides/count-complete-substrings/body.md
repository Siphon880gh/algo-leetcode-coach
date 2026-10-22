## Fixed-length windows

1. Split word into pieces where `|word[i] − word[i − 1]| > 2`.
2. For each piece and d = 1 … 26 with d·k ≤ length: slide a window of length d·k and count windows where every present letter appears exactly k times.

Examples → 3, 6. Checked against testing every substring on 800 random words.

Fixing the length is what makes a window work: “each count ≤ k” alone does not tell where a complete substring ends.

Time: O(26 · 26 · n)  
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
