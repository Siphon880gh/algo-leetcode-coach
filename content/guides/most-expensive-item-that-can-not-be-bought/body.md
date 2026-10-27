You have unlimited coins of two different prime values. Return the largest price that cannot be paid exactly with them. Limits are in the official statement. For instance, values 2 and 5 → 3, and 5 and 7 → 23. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Formula

1. Return `p·q − p − q`.

Constructed checks (run in code): the examples above; every pair of primes below 25 matches a reachability DP up to p·q.

A DP over amounts up to p·q also works and needs no theory, at O(p·q) time.

Time: O(1)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
