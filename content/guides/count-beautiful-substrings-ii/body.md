## Hash prefix states

1. m = smallest positive integer with `m² mod k = 0`.
2. Walk prefixes i = 0 … n with balance = vowels − consonants; key = (balance, i mod 2m). Add the count of earlier equal keys, then record this key.

Examples → 2, 3, 0. Checked against part I on 1,500 random strings.

Requiring v to be a multiple of k is too strict: baab with k = 4 → 0 instead of 1 (v = 2 and 2 · 2 = 4).

Time: O(n + √k)  
Space: O(n)

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
