## Count by parts and end

1. If `s[0]` is not prime or `s[n − 1]` is prime, return 0.
2. `ok(i)`: a cut before index `i` is allowed when `i = n`, or `s[i]` is prime and `s[i − 1]` is not.
3. `dp_0[0] = 1`. For `j = 1 … k`: sweep `i = 1 … n`, adding `dp_{j−1}[i − minLength]` to `acc` when `i − minLength` is 0 or allowed; set `dp_j[i] = acc` when `ok(i)`.
4. Return `dp_k[n]` mod 10^9 + 7.

Examples → 3, 1, 1. Checked against trying every set of cuts on 300 random strings.

The running sum adds every earlier valid start at most i − minLength, so each part is long enough without an inner loop.

Time: O(k · n)  
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
