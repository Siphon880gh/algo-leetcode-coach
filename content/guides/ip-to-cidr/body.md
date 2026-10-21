Given a starting IPv4 address and a count `n`, return the shortest list of CIDR blocks (like `"255.0.0.8/29"`) that covers exactly the `n` addresses starting at that IP, with no address outside that range. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Aligned blocks

A CIDR block of size `2^b` must start at an address divisible by `2^b`. So from address `x`:

1. `step = x & −x`, the largest block aligned at `x` (if `x == 0`, any power of two is aligned; use 2³²).
2. While `step > n`, halve it.
3. Emit `x` with prefix length `32 − log2(step)`.
4. `x += step`, `n −= step`. Repeat while `n > 0`.

Taking the largest valid block each time is optimal: any cover must split at the same alignment boundaries.

Convert between dotted form and the integer with shifts: `a << 24 | b << 16 | c << 8 | d`.

Do not emit one `/32` per address; the answer must be the shortest list. Do not take a block larger than the remaining count; it would cover addresses outside the range.

Time: O(log n · 32)  
Space: O(1) beyond the output

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
