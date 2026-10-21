## Total XOR trick

1. `tot = 1 ^ 2 ^ … ^ n`.
2. `rest = encoded[1] ^ encoded[3] ^ …` = `perm[1] ^ … ^ perm[n − 1]`.
3. `perm[0] = tot ^ rest`; then `perm[i + 1] = perm[i] ^ encoded[i]`.

`[3,1]` → `[1,2,3]`. `[6,5,4,6]` → `[2,4,1,5,3]`.

Odd n is what lets the odd-index encodings cover every element after the first exactly once.

Time: O(n)  
Space: O(n) for the output

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
