Given an integer array, return the largest value that occurs exactly once, or −1 if no value occurs once. For instance, `[5,7,3,9,4,9,8,3,1]` gives 8, and `[9,9,8,8]` gives −1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count first

1. `cnt` = occurrences of each value.
2. Return `max(v for v in cnt if cnt[v] == 1)`, or −1 if there is none.

With small bounded values, a counting array scanned from the top works too.

Do not sort and return the last element; it may be repeated. Do not treat the first non-repeating value in input order as the answer; the question asks for the largest.

Time: O(n)  
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
