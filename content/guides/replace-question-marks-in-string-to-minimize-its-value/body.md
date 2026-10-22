## Heap, then sort

1. cnt = counts of the fixed letters. Repeat once per ?: pop (count, letter), record the letter, push (count + 1, letter).
2. Sort the recorded letters; fill the ? positions in order.

Examples → abc, abac. Checked against trying every replacement on 3,000 random short strings.

Sort before filling: for abcdefghijklmnopqrstuvwxy followed by ??, the heap picks z, then a. Same value either way, but az is smaller than za.

Time: O(n log 26 + q log q)  
Space: O(26 + q)

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
