## Champion streak

1. cur = 0, wins = 0. For i = 1 … n − 1: if skills[i] > skills[cur], cur = i and wins = 1; else wins += 1.
2. If wins = k, return cur. After the loop, return cur (the strongest player).

Examples → 2, 1. Checked against simulating the queue on 500 random cases.

A new champion has already won once: resetting wins to 0 gives example 1 → 4 instead of 2. Simulating k games directly can take 10^9 rounds.

Time: O(n)  
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
