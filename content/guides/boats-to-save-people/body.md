## The heaviest decides

Sort `people`. `i = 0`, `j = n − 1`, `boats = 0`.

While `i ≤ j`:

- If `people[i] + people[j] ≤ limit`, `i += 1` (the lightest rides along).
- `j −= 1`, `boats += 1`.

Return `boats`.

If the heaviest cannot pair with the lightest, they cannot pair with anyone, so they go alone. If they can, pairing them with the lightest leaves heavier partners for others, which is never worse.

Each boat holds at most two people, so there is no point searching for a third.

Do not pair the two heaviest or the two lightest first. Do not use a hash map of complements; the best partner need not sum exactly to the limit.

Time: O(n log n)  
Space: O(1) besides the sort

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
