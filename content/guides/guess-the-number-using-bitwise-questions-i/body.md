There is a hidden number n. You may call an API, named in the statement, with a number num; it returns how many set bits n and num have in common, that is, the number of 1 bits in n AND num. Find n. The API name and limits on n are in the official statement. For instance, if n = 31, asking with 1, 2, 4, 8, 16 each returns 1, and asking with 32 returns 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One question per bit

This assumes the API counts common set bits as restated above.

1. n = 0. For each bit i the limit allows: if api(2^i) = 1, n |= 2^i.
2. Return n.

Constructed checks (run in code): n = 31 and n = 33 recovered; 2,000 random n below 2^30 recovered with 30 questions each.

Asking with all ones only returns the number of set bits, not which ones: 3 and 5 both give 2.

Time: O(bits) questions  
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
