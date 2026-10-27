## Repeat until identity

1. `perm = [0 … n − 1]`, `ops = 0`.
2. Build `arr[i] = perm[i / 2]` for even `i`, `perm[n / 2 + (i − 1) / 2]` for odd `i`; `ops += 1`.
3. Stop when `arr` is the identity.

`n = 2` → 1. `n = 4` → 2. `n = 6` → 4. Constructed: `n = 8` → 3.

Tracking only where index 1 travels gives the same answer in O(n), since index i moves to 2i mod (n − 1) (ends fixed), so every cycle length divides the length of the cycle through 1, the multiplicative order of 2 mod n − 1 (checked against simulation for n < 200).

Time: O(n²) simulation  
Space: O(n)

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
