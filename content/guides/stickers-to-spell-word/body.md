## State = covered positions

Let `t = |target| ≤ 15`. A mask of `t` bits says which positions are already spelled. Start at mask 0 and aim for `(1 << t) − 1`.

Applying a sticker to a mask: copy its letter counts, then for each unset position `i` with `target[i]` still available in the copy, set bit `i` and use up that letter. That gives the next mask.

BFS (or `dp[mask]` filled in increasing mask order) gives the fewest stickers. The key pruning: find the lowest unset position, and only try stickers containing that letter. Some sticker must cover it eventually, and the order you use stickers in does not matter, so this loses nothing and cuts most branches.

If some target letter appears in no sticker, return `-1` right away.

Do not search over sticker multisets without memoization; the count explodes. Do not memoize on the raw remaining string without sorting it, or equal states will look different.

Time: O(2^t · S · t), for S stickers  
Space: O(2^t)

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
